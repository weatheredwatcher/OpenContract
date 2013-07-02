<?php

/**
*
* File that will change the curret year 
*
*
*/
ini_set('display_errors','On'); 

include('../config.php');
include('../includes/globalinc.php');
## This is the testing Agency
//$agency = "H12";  //Comment out once everything is ready
##
$agency = $_GET['id'] ;
$tmpfname = tempnam("../downloads", $agency) . ".csv";
$handle = fopen($tmpfname, "w");

$query = "SELECT * FROM tbl_idc WHERE agency = '$agency'";
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)):
	
$agency = get_agency_name($row['agency']);
$idc_number = $row['idc_id_internal'];
$scope_of_contract = $row['scope_of_work'];
$contractor = mysql_escape_string($row['contractor']);
$commencement = $row['commencement'];
$expiration = $row['expiration'];
$idc_id = $row['id'];

#IDC

## Build Header

	fwrite($handle, "\"Agency Name\",\"$agency\"\n");
	fwrite($handle, "\"IDC Number\",\"$idc_number\"\n");
	fwrite($handle, "\"IDC Project Name\",\"$scope_of_contract\"\n");
	fwrite($handle, "\"IDC Contractor\",\"$contractor\"\n");
	fwrite($handle, "\"Effective Date\",\"$commencement\"\n");
	fwrite($handle, "\"Termination Date\",\"$expiration\"\n");
	fwrite($handle, "\n"); 
	fwrite($handle, "\n"); 
	fwrite($handle, "\n"); 
	



#DO
//$idc_id = $row['agency'];
$do_query = "SELECT * from tbl_dos WHERE idc_id = '$idc_id'";
//echo $do_query;
$do_result = mysql_query($do_query)or die(mysql_error());

## Build Heading
fwrite($handle, "\"DO Number\",\"DO Date\",\"DO Amount\",\"Contract Total\",\"Remaining Balance\",\"OSE REV\",\"Project Name\"\n");

## Build Lines
while ($do_row = mysql_fetch_assoc($do_result)):
	$do_id = $do_row['do_id'];
	$do_date = $do_row['order_date'];
	$do_amount = $do_row['basic'];
	$contract = $row['award_Amount'];
	$balance = $contract - $do_amount;
	$ose = $do_row['ose_verify'];
	$pro_name = $do_row['pro_name'];
$string = "\"$do_id\",\"$do_date\",\"$do_amount\",\"$contract\",\"$balance\",\"$ose\",\"$pro_name\"\n";
//echo $string;
	fwrite($handle, $string);

	endwhile;
fwrite($handle, "\n"); 
fwrite($handle, "\n"); 
fwrite($handle, "\n"); 

endwhile;

#Write to File
//$tmpfname = tempnam("../downloads", "FOO");

//$handle = fopen($tmpfname, "w");
echo ("<a href=$tmpfname>download</a>");

//end of file