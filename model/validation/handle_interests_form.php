<?php
/**
 *  Validation for Interests Form.
 * 
 *  @author Jacob Landowski
 */

require_once 'functions.php';

$memberData = $_SESSION['member_data'];

    //  Selecting nothing returns nothing,
    //  this will add an empty array if this is the case
$indoorInterests  = isset($_POST['indoor_interests'])  ? $_POST['indoor_interests']  : []; 
$outdoorInterests = isset($_POST['outdoor_interests']) ? $_POST['outdoor_interests'] : [];

if(!validIndoor($indoorInterests, $indoorOptions)) 
    $errors['indoor'] = 'Please select valid indoor options';
else
    $_SESSION['indoor_chosen'] = $indoorInterests;

if(!validOutdoor($outdoorInterests, $outdoorOptions)) 
    $errors['outdoor'] = 'Please select valid outdoor options';
else
    $_SESSION['outdoor_chosen'] = $outdoorInterests;

if(!isset($errors['indoor']) && !isset($errors['outdoor']))
{
        //  FOR CHECKBOX DISPLAY OPTIONS
    require_once 'model/structures/interests_form_structure.php';

        //  GET ARRAY OF ALL CHOSEN INTERESTS
        //  AS ITS DISPLAY VALUE
    $options   = array_merge($indoorOptions, $outdoorOptions);
    $interests = array_merge($outdoorInterests, $indoorInterests);
    $displayedInterests = [];

        //  GET DISPLAY FRIENDLY VERSION OF EACH
    foreach($interests as $interest)
        $displayedInterests[] = $options[$interest];
    
    $memberData->setValue('interests', implode(', ', $displayedInterests));
}
