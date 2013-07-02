<?php
/**
*
*  Global Includes Files
*
*
*  @author David Duggins
*  
*
*

Functon Lists:
get_agency_name(int id)
   Send the agency id and returns the Agency long name

log_activity(string activity,  string extra)
	Major funciton, see function documentation for usage

get_quarter(string month)
	Given the month as a string (Jan, Feb) returns the quarter as a number (1,2,3,4)

get_quarter_range(string month) 
	Given the month, returns the date range for the quarter that month is in
previous_quarter()
	Check the date and returns the previous quarter
get_do_totals(int idc)
	Returns all DO totals for a given IDC 
get_do_totals_previous(int idc)
	Returns all DO totals for a given IDC, previous quarter

get_do_reimbursements($int idc)
	Returns all reimbursements for a given IDC
getStartDate()
	Based on the current date, returns the start date for the current Quarter (specific to the date picker)
getEndDate()
	Based on the current date, returns the end date for the current Quarter (specific to the date picker)
f_getStartDate()
	Based on the current date, returns the start date for the current Quarter, formatted for MySql (YYYY-MM-DD)
f_getEndDate()
	Based on the current date, returns the end date for the current Quarter, formatted for MySql (YYYY-MM-DD)


*/

#GLOBALS


require_once('db-include.php');

function get_agency_name($id){
	/**
	*
	* Simple helper function that pulls the real name of the agency based on the id
	*
	*/

	$query = "SELECT name FROM tbl_agency WHERE id = '$id'";
	$results = mysql_query($query);
	while($row = mysql_fetch_assoc($results)){

		$name = $row['name'];

		return $name;
	}
}

function get_auditor_name($id){
    /**
    *
    * Simple helper function that pulls the real name of the agency based on the id
    *
    */

    $query = "SELECT name FROM tbl_auditor WHERE email = '$id'";
    $results = mysql_query($query);
    while($row = mysql_fetch_assoc($results)){

        $name = $row['name'];

        return $name;
    }
}


function log_activity($activity, $extra) {

/** 
*  This is the log function
*  We have several custom activities defined, but you can log any activity without configuing it here
*
*
*  base usage: log_activity(string $activity, string $extra);
*
*   The default will log the activity, the ip address, the time stamp in question and anything that has been assigned 
*   into the session variable $_SESSION['extra'].  A $extra variable was added in case session data is not available, like 
*   during a cron job.  Note: You MUST create a custom activity to use the $extra variable.
*
*  So, if in the code you assign:
*  $_SESSION['extra'] = $some_data;
*  log_activity('Audit DO');
*
*
*  The log will contain: [Audit DO, IP_ADDRESS, content of $some_data, timestamp]
*
*/
	switch ($activity) {
		case 'login':
			$ip_address = $_SESSION['log_ip'];
			$extra = mysql_escape_string($_SESSION['name']);
			$timestamp = $_SESSION['ses_start'];  //for login we assign a timestamp at login for accuracy
			
			break;
		case 'logout':
			$ip_address = $_SESSION['log_ip'];
			$extra = mysql_escape_string($_SESSION['name']);
			$timestamp = $_SESSION['ses_end'];  //at logout we assign a timestamp for accuracy
			
			break;
		case 'idc':
			$ip_address = $_SESSION['log_ip'];
			$extra = mysql_escape_string($_SESSION['extra']);
			$timestamp = date('Y-m-d-h-i-s'); //normally, the timestamp can just be set at log time.
			
			break;

		case 'do':
			$ip_address = $_SESSION['log_ip'];
			$extra = mysql_escape_string($_SESSION['extra']);
			$timestamp = date('Y-m-d-h-i-s');  //normally, the timestamp can just be set at log time.
			
			break;

		case 'purge':
			$ip_address = 'localhost';
			$extra = $extra;
			$timestamp = date('Y-m-d-h-i-s');  //normally, the timestamp can just be set at log time.
			
			break;
		
		default:
			//you can use the default for most logging, just give the activity name in the function call.
			$ip_address = $_SERVER['REMOTE_ADDR'];
			$extra = mysql_escape_string($_SESSION['extra']);
			$timestamp = date('Y-m-d-h-i-s');
			break;
	}

	$query = "INSERT INTO log (activity, ip_address, extra, timestamp) VALUES('$activity', '$ip_address', '$extra', '$timestamp')";
			mysql_query($query) or die(mysql_error());






}


function get_quarter($month){

switch ($month)
    {
    case ($month=='Jan' || $month=='Feb' || $month=='Mar'):
        $quarter = "3";
        break;
    case ($month=='Apr' || $month=='May' || $month=='Jun'):
        $quarter = "4";
        break;
    case ($month=='Jul' || $month=='Aug' || $month=='Sep'):
        $quarter = "1";
        break;
    case ($month=='Oct' || $month=='Nov' || $month=='Dec'):
        $quarter = "2";
        break;
    } 

    return $quarter;

}

function get_quarter_range($month) {
global $firstQuarterStarts;
global $firstQuarterEnds;
global $secondQuarterStarts;
global $secondQuarterEnds;
global $thirdQuarterStarts;
global $thirdQuarterEnds;
global $fourthQuarterStarts;
global $fourthQuarterEnds;

$quarter = get_quarter($month);

switch ($quarter)
    {
    case 1:
    	$range = $firstQuarterStarts.' through '.$firstQuarterEnds;
        break;
    case 2:
    	$range = $secondQuarterStarts.' through '.$secondQuarterEnds;
        break;
    case 3:
    	$range = $thirdQuarterStarts.' through '.$thirdQuarterEnds;
        break;
    case 4:
    	$range = $fourthQuarterStarts.' through '.$fourthQuarterEnds;
        break;
    } 

return $range;

}

function previous_quarter(){

     $current = get_quarter(date('M'));
     if ($current == 1){
     $previous = "4th Quarter, ".date('Y') - 1;
     }

     if ($current == 2) { $previous = "1st Quarter, ".date('Y'); }
     if ($current == 3) { $previous = "2nd Quarter, ".date('Y'); }
     if ($current == 4) { $previous = "3rd Quarter, ".date('Y'); }
return $previous;
}

function current_quarter(){

     $current = get_quarter(date('M'));
     if ($current == 1) { $previous = "1st Quarter, ".date('Y'); }
     if ($current == 2) { $previous = "2nd Quarter, ".date('Y'); }
     if ($current == 3) { $previous = "4rd Quarter, ".date('Y'); }
     if ($current == 4) { $previous = "4th Quarter, ".date('Y'); }
return $previous;
}

function get_do_totals($idc){
	$start_date = f_getStartDate();
    $query2="select * from tbl_dos where idc_id=$idc and order_date > '$start_date'";
	//$query2="SELECT * FROM tbl_dos WHERE idc_id = '$idc'";
	$results2 = mysql_query($query2) or die(mysql_error());
	#$array = mysql_fetch_array($results2, MYSQL_NUM);
	$counter = 0 ;
	$counter2 = 0;
	while($row2 = mysql_fetch_assoc($results2)):
		
		$counter += $row2['basic'];
		//$counter += $row2['additional'];
		
	   // echo $row2['basic'];
    	//echo $row2['additional'];
    endwhile;

    return $counter;

}

function get_do_totals_previous($idc){
	$start_date = f_getStartDate();
	$query2="select * from tbl_dos where idc_id=$idc and order_date < '$start_date'";
	
	$results2 = mysql_query($query2) or die(mysql_error());
	
	$counter = 0 ;
	while($row2 = mysql_fetch_assoc($results2)):
		
		$counter += $row2['basic'];
	
	endwhile;

    return $counter;

}




function get_do_reimbursements($idc){
	
	$query2="SELECT * FROM tbl_dos WHERE idc_id = '$idc'";
	$results2 = mysql_query($query2) or die(mysql_error());
	#$array = mysql_fetch_array($results2, MYSQL_NUM);
	$counter = 0 ;
	$counter2 = 0;
	while($row2 = mysql_fetch_assoc($results2)):
		
		$counter += $row2['reimbursed'];
		
		
	   // echo $row2['basic'];
    	//echo $row2['additional'];
    endwhile;

    return $counter;
    
}


function getStartDate(){

global $year;
global $sechalf;
$previous = $year - 1;

$month = date('M');

switch($month){
	
	case ($month=='Jan'):
 			$start = '1001'.$year;
		break;
	case ($month=='Feb' || $month=='Mar'):
        $start = '0101'.$sechalf;
        break;
    case ($month=='Apr'):
    	$start = '0101'.$sechalf;
    //
    break;
    case ($month=='May' || $month=='Jun'):
        $start = '0401'.$sechalf;
        break;
    case ($month=='Jul'):
    		$start = '0601'.$previous;
         //
    break;

    case ($month=='Aug' || $month=='Sep'):
        $start = '0701'.$year;
        break;
    case ($month=='Oct'):
    	$start = '0701'.$year;
    break;
    case ($month=='Nov' || $month=='Dec'):
        $start = '1001'.$year;
        break;
}
return $start;

}

function getEndDate(){

global $year;
global $sechalf;
$previous = $year - 1;

$month = date('M');

switch ($month) {
	
 case ($month=='Jan' || $month=='Feb' || $month=='Mar'):
        $ends = '0331'.$sechalf;
        break;
    case ($month=='Apr' || $month=='May' || $month=='Jun'):
        $ends = '0630'.$sechalf;
        break;
    case ($month=='Jul' || $month=='Aug' || $month=='Sep'):
        $ends = '0930'.$year;
        break;
    case ($month=='Oct' || $month=='Nov' || $month=='Dec'):
        $ends = '1231'.$year;
        break;

}
return $ends;

}


function f_getStartDate(){

global $year;
global $sechalf;
$previous = $year - 1;

$month = date('M');

switch($month){
	
	case ($month=='Jan'):
 			$start = $year.'-10-01';
		break;
	case ($month=='Feb' || $month=='Mar'):
        $start = $sechalf.'-01-01';
        break;
    case ($month=='Apr'):
    	$start = $sechalf.'-01-01';
    //
    break;
    case ($month=='May' || $month=='Jun'):
        $start = $sechalf.'-04-01';
        break;
    case ($month=='Jul'):
    		$start = $previous.'-06-01';
         //
    break;

    case ($month=='Aug' || $month=='Sep'):
        $start = $year.'-07-01';
        break;
    case ($month=='Oct'):
    	$start = $year.'-07-01';
    break;
    case ($month=='Nov' || $month=='Dec'):
        $start = $year.'-10-01';
        break;
}
return $start;

}

function f_getEndDate(){

global $year;
global $sechalf;
$previous = $year - 1;

$month = date('M');

switch ($month) {
	
 case ($month=='Jan' || $month=='Feb' || $month=='Mar'):
        $ends = $sechalf.'-03-31';
        break;
    case ($month=='Apr' || $month=='May' || $month=='Jun'):
        $ends = $sechalf.'-06-30';
        break;
    case ($month=='Jul' || $month=='Aug' || $month=='Sep'):
        $ends = $year.'-09-30';
        break;
    case ($month=='Oct' || $month=='Nov' || $month=='Dec'):
        $ends = $year.'-12-31';
        break;

}
return $ends;

}

function check_closed_idc(){

  


}


function generate_csv_data($data,$use_key=false,$delm=',') {
  $output = NULL;
  if(is_array($data)) {
    if($use_key == false) {
      if(isset($data[0]) && is_array($data[0])) {
        foreach($data as $key) {
          $output .= implode($delm,$key);
          $output .= "\n";
        }
      } else {
        $output .= implode("$delm", $data)."\n";
      }
    } else {
      foreach($data as $key => $value) {
        $output .= "$key{$delm}$value\n";
      }
    }
  } else {
    $output = $data;
  }
  if(empty($output)) {
    trigger_error('OUTPUT WAS EMPTY!', E_USER_ERROR);
    return false;
  }
  return $output;
}

//end of globalinc.php