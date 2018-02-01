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
// start session after autoload

$f3 = Base::instance();
$f3->set('DEBUG', 3);

  //================================================//
 //                   PRE-ROUTE                    //
//================================================//

require_once 'model/routing_functions.php';

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

        //  IF INVALID ROUTE
    if(!array_key_exists($route, FORMS)) 
        $f3->error(404);

        //  INTEREST CHECKBOX OPTIONS
    if($route === 'interests')
    {
        require_once 'model/structures/interests_form_structure.php';
        $f3->set('indoor_options', $indoor_options);
        $f3->set('outdoor_options', $outdoor_options);
    }    

        //  IF FORM SUBMITTED : VALIDATE
    if(isPOST()) 
        require_once "model/validation/validate_{$route}_form.php";

        //  STANDARD RENDER TOKENS
    $f3->mset([
        'route'     => $route,
        'formTitle' => FORMS[$route]['title'],
        'formGuts'  => FORMS[$route]['guts']
    ]);

    echo Template::instance()->render('views/form_page.html');
});

    //  SUMMARY ROUTE
$f3->route('GET /summary', function()
{
    echo Template::instance()->render('views/profile_summary.html');
});


$f3->run();