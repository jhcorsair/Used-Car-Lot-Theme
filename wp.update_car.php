<?php
/**
 * @author James Haney
 * @copyright 2012
 */

unset($_POST['submit']);


foreach ($_POST as $key => &$value) {

    lcfirst($_POST['sold']);

    $new_array[$key] = $value;
}

require_once ('../../../wp-load.php');
global $wpdb;
//var_dump( isset( $wpdb ) );

$where = array('id' => "$new_array[id]");
//print_r($where);

$date = date("Y-m-d");
$table = $wpdb->prefix."cars";
$wpdb->update($table, $new_array, $where);


$page_title = 'Edit Inventory';
$page = get_page_by_title($page_title);
header("Location:$page->guid");
