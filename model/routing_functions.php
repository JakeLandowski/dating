<?php
/**
 *  Tells if request was through POST
 * 
 *  @return boolean     True if request is POST
 */
function isPOST()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

/**
 *  Tells if request was through GET
 * 
 *  @return boolean     True if request is GET
 */
function isGET()
{
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}

