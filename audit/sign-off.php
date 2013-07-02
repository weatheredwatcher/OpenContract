<?php
/**
 * This is a collection of functions dealing with DO ajax calls.
 */
session_start();
require('../config.php');
require('../includes/globalinc.php');

$row_id = $_GET['id'];
$name = $_SESSION['name'];



	   
$query = "UPDATE  tbl_dos set ose_verify = '$name' WHERE id='$row_id'"; 
		
mysql_query($query)or die(mysql_error());

echo $row_id . " " . $name; 