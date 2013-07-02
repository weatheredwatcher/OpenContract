<?php
# php4.3 script
# this is not meant to be run in a browser

ini_set('display_errors','On'); 

$thismonth = date("m", strtotime("this month"));

$nextmonth = date("m", strtotime("next month"));

echo $thismonth.'<br />';
echo $nextmonth.'<br />';





?>