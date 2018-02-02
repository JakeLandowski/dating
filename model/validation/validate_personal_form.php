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
 *  Validates a given phone number.
 * 
 *  @param int $phone     The int being validated.
 *  @return boolean       True if phone number is valid
 */
function validPhone($phone)
{
    $phone = preg_replace('/[^0-9]/', '', $phone);
    $len = strlen($phone);

    return !empty($phone) && $len === 10;  
}

$firstName   = isset($_POST['first_name'])   ? $_POST['first_name']   : null;
$lastName    = isset($_POST['last_name'])    ? $_POST['last_name']    : null;
$age         = isset($_POST['age'])          ? $_POST['age']          : null;  
$phoneNumber = isset($_POST['phone_number']) ? $_POST['phone_number'] : null;

if(!validName($firstName)) 
    $errors['first_name'] = 'Please enter a valid first name';
else
    $_SESSION['first_name'] = $firstName;

if(!validName($lastName)) 
    $errors['last_name'] = 'Please enter a valid last name';
else
    $_SESSION['last_name'] = $lastName;

if(!validAge($age)) 
    $errors['age'] = 'Please enter a valid age';
else
    $_SESSION['age'] = $age;

if(!validPhone($phoneNumber)) 
    $errors['phone_number'] = 'Please enter a valid phone number';
else
    $_SESSION['phone_number'] = $phoneNumber;

    // NOT VALIDATED
$_SESSION['gender'] = isset($_POST['gender']) ? $_POST['gender'] : '';