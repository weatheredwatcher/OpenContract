<?php
#config.php
/**

This is the main config file for the IDC application.  It will take the place of the db-connect file.

*/

//ini_set('display_errors','On'); 

## Database Config

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'db_idcs';

## End Database Config

## Local Configurations
setlocale(LC_MONETARY, 'en_US');

## Global Dates Configuration

/**
This is important to make sure that all the dates work properly.

*/
$year_check=date('n');

if($year_check < 7 ): 

$year = date('Y', strtotime('last year'));
$sechalf = date('Y');
endif;

if($year_check >= 7): 

$year = date('Y');
$sechalf = date('Y', strtotime('next year'));
endif;
## Here
$fiscal_year_starts = $year."-07-01";
$firstQuarterStarts = $fiscal_year_starts;
$firstQuarterEnds = $year."-09-30";
$secondQuarterStarts = $year."-10-01";
$secondQuarterEnds = $year."-12-31";
$thirdQuarterStarts = $sechalf."01-01";
$thirdQuarterEnds = $sechalf."03-31";
$fourthQuarterStarts = $sechalf."-04-01";
$fourthQuarterEnds = $sechalf."-06-30";

$fiscalyear = $year.'-'.$sechalf;


## End Global Dates Configuration


















mysql_connect($host, $username, $password) or die(mysql_error());
mysql_select_db($database) or die(mysql_error());

## End of the Config File
?>