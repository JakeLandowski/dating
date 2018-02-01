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
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}