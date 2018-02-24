<?php
/**
 *  Validation Functions for Forms.
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
    if(empty($whiteList)) return false;

    foreach($set as $option)
    {
        if(!array_key_exists($option, $whiteList)) return false;
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