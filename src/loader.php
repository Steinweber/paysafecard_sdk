<?php
require_once '_config.php';
$helper = glob(DIR_HELPER_GLOBAL.'*.php');
foreach($helper as $function)
{
    include_once $function;
}

final class Loader
{
    public function __construct($loadClass)
    {
        include_once DIR_FUNCTION.'base.php';
        if(file_exists(DIR_FUNCTION.$loadClass.'/loader.php'))
        {
            include_once DIR_FUNCTION.$loadClass.'/loader.php';
        }
    }
}