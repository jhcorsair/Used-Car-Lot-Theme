<?php

/**
 * @author James Haney
 * @copyright 2014
 */


spl_autoload_register(function($class)
 {
  require_once 'classes/' . $class . '.php';
  });

   
require_once'wpinit.php';

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => wpconfig::get('db/host'),
        'username' => wpconfig::get('db/user'),
        'password' => wpconfig::get('db/pass'),
        'db' => wpconfig::get('db/name')
        ),
        
        'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800),
        
        'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
        )
   );
   
    
      
   
   
   //require_once 'functions/sanitize.php';
   
   
   if(Cookie::exists(Config::get('remember/cookie_name'))){
    
     if(!Session::exists(Config::get('session/session_name'))){
        
           $hash = Cookie::get(Config::get('remember/cookie_name'));
           $hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));
           
           if($hashCheck->count()){
            $user = new User($hashCheck->first()->user_id);
            $user->login();
           }
        }
     }
   
   //echo wpconfig::get('wpdb/host');
