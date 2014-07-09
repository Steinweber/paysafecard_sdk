<?php 
include_once '_config.php'; 

$dir = __DIR__.'/';
$helper = glob($dir.'helper/*.php');
foreach($helper as $function)
{
    include_once str_replace($dir,'',$function);
}

final class Loader
{
    public function __construct($loadClass)
    {
        if(file_exists(__DIR__.'/function/'.$loadClass.'/loader.php'))
        {
            include_once __DIR__.'/function/'.$loadClass.'/loader.php';
        }
    }
    
}