<?php
/**
 * This is a collection of functions dealing with DO ajax calls.
 */
session_start();
require('includes/db-include.php');
require('includes/globalinc.php');

$row_id = $_GET['id'];
$factory = $_GET['factory'];
$date = $_GET['date'];
$do_id = $_GET['do_id'];
$pro_name = $_GET['pro_name'];
$basic = $_GET['basic'];
$reimbursed = $_GET['reimbursed'];
$idc_id = $_SESSION['idc_id'];

if($_GET['amendment'] == "on")
{
	$amendment = 1;
} else {
	$amendment = 0;
	}


switch($factory){

	case "insert": 
	  // code to insert the DO into the database
	   $query = "INSERT INTO tbl_dos (idc_id, order_date, do_id, pro_name, basic,reimbursed, amendment) VALUES ('$idc_id', '$date', '$do_id', '$pro_name', '$basic', '$reimbursed', '$amendment')"; 
		
	   mysql_query($query) or die(mysql_error());
        $_SESSION['extra'] = "idc id=".$idc_id.", do id=".$do_id.", project:".$pro_name.", amount:".$basic;
        log_activity('do');
		echo "Inserted!";
	  	break;
	case "update":
		//code tp update the DO
		$query = "UPDATE  tbl_dos set order_date='$date' , do_id='$do_id', pro_name='$pro_name', basic='$basic', reimbursed='$reimbursed' WHERE id='$row_id'"; 
		
	   mysql_query($query) or die(mysql_error());
        $_SESSION['extra'] = "idc id=".$idc_id.", do id=".$do_id.", project:".$pro_name.", amount:".$basic;
        log_activity('updated do');
		echo "Updated row:".$row_id;
	 	break;
	case "delete":
		
		$query = ("DELETE FROM tbl_dos where id='$do_id'");
		
		mysql_query($query)or die(mysql_error());
		echo "Entry ".$do_id." deleted";
		break;
	


}