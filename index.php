<?php

/**
 *  Jacob Landowski
 *  1 - 17 - 18
 *  Route controller for Dating Site assignment. 
*/  

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'vendor/autoload.php';

$f3 = Base::instance();
$f3->set('DEBUG', 3);

$f3->route('GET /', function()
{
    $template = new Template();

    echo $template->render('pages/home.html');
});

$f3->run();