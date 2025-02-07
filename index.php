<?php 

    /*** PREVENT THE PAGE FROM BEING CACHED BY THE WEB BROWSER ***/
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    
    header("Content-type: text/html");
    date_default_timezone_set('America/Los_Angeles');
    
    define('BASE_PATH', __DIR__);

    $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/';
    define('BASE_URL', $baseUrl);
    
    require 'autoload.php';
    require 'router.php';
  
?>