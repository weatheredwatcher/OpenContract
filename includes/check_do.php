<?php
## 
# This file is called via ajax.

require('db-include.php');
require('globalinc.php');
session_start(); 

$do_id = $_GET['id'];

$query= ("SELECT id FROM tbl_dos WHERE do_id='$do_id' LIMIT 1");

$results = mysql_query("$query")or die(mysql_error());

if(mysql_num_rows($results) == 1) {
   
	echo true;
}



?>