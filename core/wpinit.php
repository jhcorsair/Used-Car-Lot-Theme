<?php

/**
 * @author James Haney
 * @copyright 12/2015
 */ 

 $url = home_url();
//echo $url;
 
//find the path if SERVER/folder
$f = $url . '/wordpress/wp-config.php';

if (is_file($f)) {
    
   // echo("$f is a valid FILE");
    
    $f = $url . '/wordpress/wp-config.php';
    
} else {
    
    $f = $url . '/wp-config.php';
    
   // echo("$f is a valid FILE");
    }



//$f = $_SERVER['DOCUMENT_ROOT'] . "/used-car-lot/wp-config.php";
//$f;
$c = file_get_contents($f);

preg_match('/define.*DB_NAME.*\'(.*)\'/', $c, $m);
$dbname = $m[1];

preg_match('/define.*DB_USER.*\'(.*)\'/', $c, $m);
$dbuser = $m[1];

preg_match('/define.*DB_PASSWORD.*\'(.*)\'/', $c, $m);
$dbpass = $m[1];

preg_match('/define.*DB_HOST.*\'(.*)\'/', $c, $m);
$dbhost = $m[1];

//echo $dbname, $dbuser, $dbpass, $dbhost;

$GLOBALS['wpconfig'] = array(
    'db' => array(
        'name' => $dbname,
        'user' => $dbuser,
        'pass' => $dbpass,
        'host' => $dbhost   
    )
);







?> 
