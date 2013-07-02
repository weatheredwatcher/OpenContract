<?php
/**
 *  
 *  This code take the parameter of the do Id and returns the content of that do back to the program as a json object
 *  
 */

session_start();
require('includes/db-include.php');
require('includes/globalinc.php');

$do_id = $_GET['do_id'];


$query = "SELECT * FROM tbl_dos where id='$do_id'";

$result = mysql_query($query)or die(mysql_errno());

while ($row = mysql_fetch_assoc($result)):
$order_date = $row['order_date'];
$do = $row['do_id'];
$pro_name = $row['pro_name'];
$basic = $row['basic'];
$reimbursed = $row['reimbursed'];
$amendment = $row['amendment'];

//here we build the json object

$res = "{'order_date':'$order_date', 'do_id':'$do', 'pro_name':'$pro_name', 'basic':'$basic', 'reimbursed':'$reimbursed', 'amendment':'$amendment'}";

endwhile;

echo $res;

?>