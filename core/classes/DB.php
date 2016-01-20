<?php

/**
 * @author James Haney
 * @copyright 2015
 */

class DB 
    {
        private static $_instance;
        private $_pdo,
                $_query,
                $_error = false,
                $_results,
                $_count = null;
                
                
        private function __construct()
        {   
           try{
            $this->_pdo = new PDO('mysql:host=' . config::get('mysql/host') .'; dbname=' . config::get('mysql/db'), config::get('mysql/username'), config::get('mysql/password'));
           } catch(PDOException $e)
         
           {
            die($e->getMessage()); 
           }
        }
        
        public static function getInstance()
        {
            if(!isset(self::$_instance))
            {
                self::$_instance = new DB();
            }
            return self::$_instance;
        }
        
        /**
        * Query with multiple parameters
        **/
        public function query($sql, $params = array())
        {
            $this->_error = false;
            if($this->_query = $this->_pdo->prepare($sql))
            {
                $x = 1;
                if(count($params))
                {
                    foreach($params as $param)
                    {
                        $this->_query->bindValue($x, $param);
                        $x++;
                    }
                }
                if($this->_query->execute())
                {
                  $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                  $this->_count = $this->_query->rowCount();
				  
                }else {
                    var_dump($this->_query->errorInfo());
                      }
                    
                }
                return $this;
        }
        
        /**
        * Query with single parameter
        **/
        public function query1($sql, $param)
        {
            $this->_error = false;
            if($this->_query1 = $this->_pdo->prepare($sql))
            {   
                $x = 1;
                $this->_query1->bindValue($x, $param);
                if($this->_query1->execute())
                {
                  $this->_results = $this->_query1->fetchAll(PDO::FETCH_OBJ);
                  $this->_count = $this->_query1->rowCount();  
                }else {
                    $this->_error = true;
                      }
                    
                }
                return $this;
        }
        
        Public function action($action, $table, $where = array())
        {
            if (count($where === 3))
            {
                $operators = array('=', '>', '<', '>=', '<=');
                
                $field =    $where[0];
                $operator = $where[1];
                $value =    $where[2];
                
                if(in_array($operator, $operators))
                {
                    $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                    
                    if(!$this->query($sql, array($value))->error())
                    {
                        return $this;
                    }
                }
            }
            return false;
        }
        
        public function get($table, $where)
        {
            return $this->action('SELECT *', $table, $where);
        }
        
        public function delete($table, $where)
        {
            return $this->action('DELETE', $table, $where);
        }
        
        public function insert($table, $fields = array())
        {
            if(count($fields))
            {
                $keys = array_keys($fields);
                $values = '';
                $x = 1;
                
                foreach($fields as $field)
                {
                    $values .= '?';
                    if($x < count($fields))
                    {
                        $values .= ', ';
                    }
                    $x++;
                }
                              
                $sql = "INSERT INTO {$table} (`" . implode('`,`', $keys) . "`) VALUES ({$values})";
                
                if(!$this->query($sql, $fields)->error())
                {
                    return true;
                }
            }
            return false;
        }
        
        /**
          * Update Single "Set" Key => Value Pair
          * Example: UPDATE `patents`.`users` SET `group` = '2' WHERE `users`.`id`='2'
          **/
            public function updateSingleSet($table, $setkey, $setvalue, $id){
            $set = "`$setkey` = '$setvalue'";
            
            
            $sql = "UPDATE&nbsp" ."`".(Config::get('mysql/db'))."`"."."; echo "`{$table}` SET {$set} WHERE `{$table}`.`id`={$id}";
            
            echo "<pre>";
            echo (Config::get('mysql/db'));
            echo "</pre>";
            
            if(!$this->query1($sql, $id)->error()){
                return true;
                echo $this->query1($sql, $id)->error();
            }
            return false;
        }
        
            /**
            * Update Multiple "Set" Key => Value Pairs
            * Example: UPDATE `patents`.`users` SET `group` = '2',`name` = 'Dave' WHERE `users`.id='2'
            **/
            public function updateMultipleSet($table, $id, $fields){
            $set = '';
            $x = 1;
            
            foreach($fields as $key => $value){
                $set .= "{$key} = '{$value}'";
                if($x < count($fields)){
                    $set .= ', ';
                }
                $x++;
            }
            
            $sql = "UPDATE {$table} SET {$set} WHERE id={$id}";
            
            if(!$this->query($sql, $fields)->error()){
                return true;
            }
            return false;
        }
        
        public function results()
        {
            return $this->_results;
        }
        
        //Red flag is ok, leave it
        public function first(){
            return $this->_results[0];
            
        }
        
        public function error()
        {
            return $this->_error;
        }
        
        public function count()
        {
            return $this->_count;
        }
    }

?>