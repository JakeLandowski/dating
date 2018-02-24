<?php
/**
 *  Validation for Profile Form.
 * 
 *  @author Jacob Landowski
 */

require_once 'functions.php';

$memberData = $_SESSION['member_data'];

$email = isset($_POST['email']) ? $_POST['email'] : null; 

if(!validEmail($email)) 
    $errors['email'] = 'Please enter a valid email';
else
    $memberData->setValue('email', $email);

    // NOT VALIDATED
$state          = isset($_POST['state'])          ? $_POST['state']          : '';
$seeking_gender = isset($_POST['seeking_gender']) ? $_POST['seeking_gender'] : '';
$biography      = isset($_POST['biography'])      ? $_POST['biography']      : '';

$memberData->setValue('state',   $state);
$memberData->setValue('seeking', $seeking_gender);
$memberData->setValue('bio',     $biography);