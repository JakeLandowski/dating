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
    return strlen($name) > 1 && ctype_alpha($name);
}

/**
 *  Validates a given age.
 * 
 *  @param int $age     The int being validated.
 *  @return boolean     True if age is valid
 */
function validAge($age)
{
    return is_numeric($age) && $age >= 18;
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

    return len == 10;  
}