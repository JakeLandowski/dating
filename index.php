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
session_start();

$f3 = Base::instance();
$f3->set('DEBUG', 3);

  //================================================//
 //                   PRE-ROUTE                    //
//================================================//

require_once 'model/routing_functions.php';

const FORMS = 
[
    'personal'  => [
                     'title'                => 'Personal Information', 
                     'guts'                 => 'views/includes/personal_form.html',
                     'member_next'          => '/profile',
                     'premium_member_next'  => '/profile'
                   ],

    'profile'   => [
                     'title'                => 'Profile Information', 
                     'guts'                 => 'views/includes/profile_form.html',
                     'member_next'          => '/summary',
                     'premium_member_next'  => '/interests'
                   ],
       
    'interests' => [
                     'title'                => 'Interests Information', 
                     'guts'                 => 'views/includes/interests_form.html',
                     'member_next'          => '/summary',
                     'premium_member_next'  => '/summary'
                   ]
];

  //================================================//
 //                    ROUTES                      //
//================================================//

// ~~~~~~~~~~~ HOME ROUTE ~~~~~~~~~~~~ //
$f3->route('GET /', function()
{
    echo Template::instance()->render('views/home.html');
});

// ~~~~~~~~~~~ FORMS ROUTE [Personal, Profile, Interests] ~~~~~~~~~~~~ //
$f3->route('GET|POST /@form', function($f3, $params)
{
    $route = $params['form'];
    $isPremium = isset($_SESSION['is_premium']) && $_SESSION['is_premium'];
    $next = $isPremium ? 'premium_member_next' : 'member_next';

        //  IF INVALID ROUTE
    if(!array_key_exists($route, FORMS)) 
        $f3->error(404);

        //  INTEREST CHECKBOX OPTIONS
    if($route === 'interests')
    {
            //  IF NOT PREMIUM SKIP INTERESTS
        if(!isset($_SESSION['is_premium']) || !$_SESSION['is_premium'])
            $f3->reroute(FORMS[$route][$next]);

            //  CONTAINS INTEREST OPTIONS ARRAY
        require_once 'model/structures/interests_form_structure.php';

        $f3->mset([
            'indoor_options'  => $indoorOptions,
            'outdoor_options' => $outdoorOptions,
            'outdoorChosen'   => $_SESSION['outdoor_chosen'],
            'indoorChosen'    => $_SESSION['indoor_chosen'],
            'is_premium'      => $_SESSION['is_premium']
        ]);
    }    
 
        //  STATE SELECT OPTIONS
    if($route === 'profile')
    {
        require_once 'model/structures/profile_form_structure.php';
        $f3->set('states', $states);
    }

        //  IF FORM SUBMITTED : VALIDATE
    if(isPOST())
    { 
        $errors = [];
        require_once "model/validation/handle_{$route}_form.php";

            //  IF NO ERRORS GO TO NEXT PAGE
        if(empty($errors)) 
        { 
            if($route === 'interests' || ($route === 'profile' && !$isPremium))
                $_SESSION['memberAdded'] = $memberData->registerMember();

            $f3->reroute(FORMS[$route][$next]);
        }

        $f3->set('errors', $errors);
    }

        //  BOTH POST|GET STANDARD RENDER TOKENS
    $f3->mset([
        'route'      => $route,
        'formTitle'  => FORMS[$route]['title'],
        'formGuts'   => FORMS[$route]['guts'],
        'memberData' => $_SESSION['member_data'] 
    ]);

    echo Template::instance()->render('views/form_page.html');
});

// ~~~~~~~~~~~ SUMMARY ROUTE ~~~~~~~~~~~~ //
$f3->route('GET /summary', function($f3)
{
    $memberData = $_SESSION['member_data'];

    $f3->mset([
        'memberData' => $memberData,
        'noData' =>'N/A',
        'memberAdded' => $_SESSION['memberAdded']
    ]);

    unset($_SESSION['memberAdded']);

    echo Template::instance()->render('views/profile_summary.html');
});


// ~~~~~~~~~~~ ADMIN ROUTES ~~~~~~~~~~~~ //
$f3->route('GET /admin', function($f3)
{
    $f3->reroute('/admin/1/10/lname');
});

$f3->route('GET /admin/@page/@per/@order', function($f3, $params)
{
    $per   = !is_numeric($params['per']) || 
             (int)$params['per'] <= 0 ? 10 : (int)$params['per'];

    $page  = !is_numeric($params['page']) || 
             (int)$params['page'] <= 0 ? 1  : (int)$params['page'];

    $start =  0 + ($page - 1) * $per;

    $order = htmlspecialchars($params['order']);

    $data = Member::getMembers($start, $per, $order);

    $totalRows = $data['totalRows'];

    $numPages = (int)($totalRows / $per) + ($totalRows % $per != 0 ? 1 : 0);

        //  If trying to nonexistant page of data
    if($page > $numPages) $f3->error(404);

    $f3->mset([
        'title'     => 'Admin Page',
        'members'   => $data['members'],
        'totalRows' => $totalRows,
        'start'     => $start,
        'per'       => $per,
        'page'      => $page,
        'order'     => $order,
        'numPages'  => $numPages
    ]);

    echo Template::instance()->render('views/admin.html');
});

// ~~~~~~~~~~~ LOGOUT ~~~~~~~~~~~~ //
$f3->route('GET /logout', function($f3)
{
    if(isset($_COOKIE[session_name()])) 
        setcookie(session_name(), '', time() - 3600, '/' );
    
    $_SESSION = array();
    session_destroy();

    $f3->reroute('/');
});



$f3->run();