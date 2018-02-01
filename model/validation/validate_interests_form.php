<?php
/**
 *  Validation for Interests Form.
 * 
 *  @author Jacob Landowski
 */

 /**
 *  Validates the In-door interests section for valid inputs.
 * 
 *  @param Array indoor     The array of indoor options being checked
 *  @return boolean         True if given options are valid
 */
function validPhone($phone)
{
    $phone = preg_replace('/[^0-9]/', '', $phone);
    $len = strlen($phone);

    return len == 10;  
}