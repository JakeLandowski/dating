<?php
/**
 *  Validation for Personal Form.
 * 
 *  @author Jacob Landowski
 */

/**
 *  Validates a given name.
 * 
 *  @param String $name     The string being validated.
 *  @return boolean         True if name is valid
 */
function validName($name)
{
    return !empty($name) && strlen($name) > 1 && ctype_alpha($name);
}

/**
 *  Validates a given age.
 * 
 *  @param int $age     The int being validated.
 *  @return boolean     True if age is valid
 */
function validAge($age)
{
    return !empty($age) &&  is_numeric($age) && $age >= 18;
}

/**
 *  Will strip the phone number of all non digit 
 *  characters and then validate its length. This
 *  modifies the given phone number.
 * 
 *  @param int &$phone     Reference to the number being validated.
 *  @return boolean        True if phone number is valid
 */
function validPhone(&$phone)
{
    $phone = preg_replace('/[^0-9]/', '', $phone);
    $len = strlen($phone);
    $isValid = !empty($phone) && $len === 10;

    if($isValid)
    {
        $phone = substr_replace($phone, '(', 0, 0);
        $phone = substr_replace($phone, ')', 4, 0);
        $phone = substr_replace($phone, '-', 5, 0);
        $phone = substr_replace($phone, '-', 9, 0);
    }

    return $isValid;  
}
    //  CHECK PREMIUM STATE OF USER
$isPremium = isset($_POST['premium_membership']);

    //  STORE USER STATE AND DATA 
$_SESSION['is_premium']  = $isPremium;

if(!exists($_SESSION['member_data']))
{
    $_SESSION['member_data'] = $isPremium ? new PremiumMember() : new Member();
}

$memberData = $_SESSION['member_data'];

$firstName   = isset($_POST['first_name'])   ? $_POST['first_name']   : null;
$lastName    = isset($_POST['last_name'])    ? $_POST['last_name']    : null;
$age         = isset($_POST['age'])          ? $_POST['age']          : null;  
$phoneNumber = isset($_POST['phone_number']) ? $_POST['phone_number'] : null;

if(!validName($firstName)) 
    $errors['first_name'] = 'Please enter a valid first name';
else
    $memberData->setFName($firstName);

if(!validName($lastName)) 
    $errors['last_name'] = 'Please enter a valid last name';
else
    $memberData->setLName($lastName);

if(!validAge($age)) 
    $errors['age'] = 'Please enter a valid age';
else
    $memberData->setAge($age);

if(!validPhone($phoneNumber)) 
    $errors['phone_number'] = 'Please enter a valid phone number';
else
    $memberData->setPhone($phoneNumber);

    // NOT VALIDATED
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$memberData->setGender($gender);