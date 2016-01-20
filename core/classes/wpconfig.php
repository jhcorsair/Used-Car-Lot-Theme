<?php

/**
 * @author James Haney
 * @copyright 2014
 */

class wpconfig 
{
    public static function get($path = null)
    {
        if($path)
        {
            $config = $GLOBALS['wpconfig'];
            $path = explode('/', $path);
          
            
            foreach($path as $bit)
            {   
                if(isset($config[$bit]))
                {
                    $config = $config[$bit];
                }
            }
            
            return $config;
        }
        
        return false;
    }
}

?>