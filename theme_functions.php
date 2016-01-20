<?php

/**
 * @author James Haney
 * @copyright 1/2016
 */

/**
 * String
 * returns page->guid 
 */
function my_get_page_link($page_title)
{
    $page = get_page_by_title($page_title);
    $link = $page->guid;

    return $link;

}

function objectToArray($d)
{
    if (is_object($d)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $d = get_object_vars($d);
    }

    if (is_array($d)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return array_map(__function__, $d);
    } else {
        // Return array
        return $d;
    }
}
?> 