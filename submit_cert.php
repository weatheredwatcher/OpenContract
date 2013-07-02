<?php
include('config.php');
$idc_id = $_GET['id'];
$cert = $_GET['cert'];
$quarter = $_GET['quarter'];
echo $idc_id;
echo $cert;

$query = "INSERT INTO tbl_certs (idc_id, certified, quarter) VALUES ('$idc_id', '$cert', '$quarter')"; 
		mysql_query($query)or die(mysql_error());


//end of submit_cert.php