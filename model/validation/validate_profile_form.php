<?php
/**
 *  Validation for Profile Form.
 * 
 *  @author Jacob Landowski
 */

/**
 *  Validates the email given, returns true if valid.
 * 
 *  @param String $email    The string being validated.
 *  @return boolean         True if email is valid
 */
function validEmail($email)
{
    return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
}

$email = isset($_POST['email']) ? $_POST['email'] : null; 

if(!validEmail($email)) 
    $errors['email'] = 'Please enter a valid email';
else
    $_SESSION['email'] = $email;

    // NOT VALIDATED
$_SESSION['state']     = isset($_POST['state'])     ? $_POST['state']     : '';
$_SESSION['seeking']   = isset($_POST['seeking'])   ? $_POST['seeking']   : '';
$_SESSION['biography'] = isset($_POST['biography']) ? $_POST['biography'] : '';