<?php
/**
 *  Validation for Personal Form.
 * 
 *  @author Jacob Landowski
 */

require_once 'functions.php';

    //  CHECK PREMIUM STATE OF USER
$isPremium = isset($_POST['premium_membership']);

    //  STORE USER STATE AND DATA 
$_SESSION['is_premium']  = $isPremium;

$memberData = $_SESSION['member_data'];

$firstName   = isset($_POST['first_name'])   ? $_POST['first_name']   : null;
$lastName    = isset($_POST['last_name'])    ? $_POST['last_name']    : null;
$age         = isset($_POST['age'])          ? $_POST['age']          : null;  
$phoneNumber = isset($_POST['phone_number']) ? $_POST['phone_number'] : null;

$memberRows = [];

if(!validName($firstName)) 
    $errors['first_name'] = 'Please enter a valid first name';
else
    $memberRows['fname'] = $firstName;

if(!validName($lastName)) 
    $errors['last_name'] = 'Please enter a valid last name';
else
    $memberRows['lname'] = $lastName;

if(!validAge($age)) 
    $errors['age'] = 'Please enter a valid age';
else
    $memberRows['age'] = $age;

if(!validPhone($phoneNumber)) 
    $errors['phone_number'] = 'Please enter a valid phone number';
else
    $memberRows['phone'] = $phoneNumber;

    // NOT VALIDATED
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$memberRows['gender'] = $gender;

if($isPremium)
{
    $memberRows['premium'] = 1;
    $_SESSION['member_data'] = new PremiumMember($memberRows);
}
else
{
    $_SESSION['member_data'] = new Member($memberRows);
} 