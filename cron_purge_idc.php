<?php
# php4.3 script
# this is not meant to be run in a browser

ini_set('display_errors','On'); 

include("includes/db-include.php") ;
require('includes/globalinc.php');


$nextmonth = date("Y-m-d", strtotime("next month"));

$query = ("UPDATE tbl_idc set active='0' WHERE expiration='$nextmonth'");

mysql_query($query)or die(mysql_error());
$extra = "IDC Records Purged:".mysql_affected_rows();
log_activity('purge', $extra);



?>