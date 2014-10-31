<?php
error_reporting( E_ALL );
if(phpversion() < 5){ DIE('PHP satisfied with the version '.phpversion().' not the requirement');}
if(!in_array('soap',get_loaded_extensions())){ echo 'The php_soap.dll was not loaded.'; exit;}
header( "Content-Type: text/html; charset=utf-8" );


//System
define('DIR_APP',__DIR__.'/');
define('DIR_FUNCTION',__DIR__.'/function/');
define('DIR_HELPER_GLOBAL',__DIR__.'/helper/global/');
define('DIR_LOG',__DIR__.'/log/');
//Usage
define('DOMAIN','http://127.0.0.1:8080/sample/');