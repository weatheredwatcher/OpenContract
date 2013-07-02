<?php

/**
*
*  This is the procedure that deletes auditors
*
*/

//ini_set('display_errors','On'); 
require_once('../config.php');
require('../includes/globalinc.php');

session_start(); #start the session so that we can see if you own this IDC
#first load the idc in question and determine ownership
$idc = $_GET['idc'];
$user = $_SESSION['id'];

$query = ("SELECT id, agency FROM tbl_idc WHERE id='$idc' AND agency = '$user' LIMIT 1");

$results = mysql_query($query)or die(mysql_error());

if(mysql_num_rows($results) == 1) {
#do nothing

 }else{

 	echo("Sorry, you do not have permissions to this IDC.");
   $_SESSION['extra'] = $user." attempted to delete IDC:".$idc;
   log_activity('Unauthorized Activity!');

 	exit();
 }

$query2 = ("SELECT id FROM tbl_dos WHERE idc_id='$idc' LIMIT 1");

$results2 = mysql_query($query2);
if(mysql_num_rows($results2) == 1) {


 	echo("Sorry, DO exist for this IDC. You cannot remove it.  Please contact the OSE.");
 	$_SESSION['extra'] = $user." attempted to delete IDC:".$idc." when it still contained DO's";
    log_activity('Failed Attempt');
 	exit();

 }
 # If we've made it this far, I guess it's okay if you delete this IDC!

 mysql_query("DELETE FROM tbl_idc WHERE id='$idc'")or die(mysql_error());
?>