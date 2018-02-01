<?php

/**
 *  Jacob Landowski
 *  1 - 17 - 18
 *  Route controller for Dating Site assignment. 
*/  

  //================================================//
 //                     SETUP                      //
//================================================//
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'vendor/autoload.php';

$f3 = Base::instance();
$f3->set('DEBUG', 3);

  //================================================//
 //                   PRE-ROUTE                    //
//================================================//

const FORMS = 
[
    'personal'  => [
                     'title' => 'Personal Information', 
                     'guts' => 'views/includes/personal_form.html'
                   ],

    'profile'   => [
                     'title' => 'Profile Information', 
                     'guts' => 'views/includes/profile_form.html'
                   ],
                   
    'interests' => [
                     'title' => 'Interests Information', 
                     'guts' => 'views/includes/interests_form.html'
                   ]
];


  //================================================//
 //                    ROUTES                      //
//================================================//

    //  HOME ROUTE
$f3->route('GET /', function()
{
    echo Template::instance()->render('views/home.html');
});

    //  FORM ROUTE
$f3->route('GET|POST /@form', function($f3, $params)
{
    $route = $params['form'];

    if(!array_key_exists($route, FORMS)) $f3->error(404);

    $f3->set('route', $route);
    $f3->set('formTitle', FORMS[$route]['title']);
    $f3->set('formGuts',  FORMS[$route]['guts']);

    echo Template::instance()->render('views/form_page.html');
});

    //  SUMMARY ROUTE
$f3->route('GET /summary', function()
{
    echo Template::instance()->render('views/profile_summary.html');
});


$f3->run();