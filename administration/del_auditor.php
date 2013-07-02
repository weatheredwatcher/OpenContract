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
$id = $_GET['id'];


 mysql_query("UPDATE tbl_auditor SET inActive='1' WHERE id='$id'")or die(mysql_error());
 header("Location: auditors.php");
?>