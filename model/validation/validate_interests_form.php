<?php
/**
 *  Validation for Interests Form.
 * 
 *  @author Jacob Landowski
 */

 /**
 *  Checks an array of given options against an array of whitelisted
 *  options.
 * 
 *  @param Array $set          The array of given options being checked
 *  @param Array $whiteList    The array of whitelisted options
 *  @return boolean            True if given options are valid
 */
function validSet($set, $whiteList)
{
    if(empty($whiteList) || empty($set)) return false;

    foreach($set as $option)
    {
        if(!in_array($option, $whiteList)) return false;
    }

    return true;
}

 /**
 *  Checks to see if the set of Indoor options chosen by the user
 *  are valid.
 * 
 *  @param Array $indoor           The array of given options being checked
 *  @param Array $indoorOptions    The array of valid indoor options
 *  @return boolean                True if given options are valid
 */
function validIndoor($indoor, $indoorOptions)
{
    return validSet($indoor, $indoorOptions);    
}

  /**
 *  Checks to see if the set of Outdoor options chosen by the user
 *  are valid.
 * 
 *  @param Array $outdoor           The array of given options being checked
 *  @param Array $outdoorOptions    The array of valid outdoor options
 *  @return boolean                 True if given options are valid
 */
function validOutdoor($outdoor, $outdoorOptions)
{
    return validSet($outdoor, $outdoorOptions);
}

$indoorInterests  = isset($_POST['indoor_interests'])  ? $_POST['indoor_interests']  : null; 
$outdoorInterests = isset($_POST['outdoor_interests']) ? $_POST['outdoor_interests'] : null;

$indoorOptions  = $f3->get('indoor_options');
$outdoorOptions = $f3->get('outdoor_options'); 

if(!validIndoor($indoorInterests, $indoorOptions)) 
    $errors['indoor'] = 'Please select valid indoor options';
else
    $_SESSION['indoor_interests'] = $indoorInterests;


if(!validOutdoor($outdoorInterests, $outdoorOptions)) 
    $errors['outdoor'] = 'Please select valid outdoor options';
else
    $_SESSION['outdoor_interests'] = $outdoorInterests;


