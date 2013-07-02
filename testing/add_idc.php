<?php
/**
*
*  Add IDC 
*
*
*/
session_start();
if (!$_SESSION['auth']){
	
header("Location: index.php");
}

ini_set('display_errors','On'); 
include('includes/testing-include.php');
require('includes/db-include.php');
require('includes/globalinc.php');

$name = $_SESSION['name'];
$id = $_SESSION['id'];

if(isset($_POST['submit'])){

	//submit the form data to the database
	$msg = "<div style='width:600px; height:100px; background-color:pink; opacity:1; color: black;'>";
	$err_check = 0;  //counts the errors in the form
	//server-side validation

	
	if($_POST['year'] == ""){ $msg .="[Year can't be empty]"; $err_check++;} 
	if($_POST['scope'] == ""){ $msg .="[Scope can't be empty]"; $err_check++;} 
	if($_POST['award'] == ""){ $msg .="[Award can't be empty]"; $err_check++;} 
	if($_POST['sum'] == ""){ $msg .="[Sum can't be empty]"; $err_check++;} 
	if($_POST['contract'] == ""){ $msg .="[Contract Balance can't be empty]"; $err_check++;} 
	if($_POST['current'] == ""){ $msg .="[Contract Balance can't be empty]"; $err_check++;} 
	if($_POST['commencement'] == ""){ $msg .="[Commencement Date can't be empty]"; $err_check++;} 
	if($_POST['expiration'] == ""){ $msg .="[Expiration Date can't be empty]"; $err_check++;}

    if($err_check == 0){ 
  		$year = mysql_escape_string($_POST['year']);
  		$quarter = mysql_escape_string($_POST['quarter']);
  		$idc_type = mysql_escape_string($_POST['idc_type']);
  		$scope = mysql_escape_string($_POST['scope']);
  		$award = mysql_escape_string($_POST['award']);
  		//$sum = mysql_escape_string($_POST['sum']);
  		//$contract = mysql_escape_string($_POST['contract']);
  		//$current = mysql_escape_string($_POST['current']);
  		$commencement = mysql_escape_string($_POST['commencement']);
  		$expiration = mysql_escape_string($_POST['expiration']);

      mysql_query("INSERT INTO tbl_idc (agency, year, quarter, idc_type, scope_of_work, award_Amount, sum_all_dos, contract_balance, current_balance, commencement, expiration) VALUES ('$id', '$year', '$quarter', '$idc_type', '$scope', '$award', '$sum', '$contract', '$current', '$commencement', '$expiration')") or die(mysql_error());        
 		//todo: write to logs
      header("Location: main.php");
     } 

	$msg .="</div>";
}

?>

<h3> New IDC for the <?=$name;?> </h3>

<?=$msg;?>

<table>
<form method="post" action="add_idc.php">
	<tr>
		<td>Calendar Year:</td>
		<td><input type="text" id="year" name="year" value="<?=$_POST['year'];?>" /></td>
	</tr>
	<tr>
		<td>Quarter</td>
		<td>
			<select id="quarter" name="quarter">
				<option value="1"> 1st Quarter </option>
				<option value="2"> 2nd Quarter </option>
				<option value="3"> 3rd Quarter </option>
				<option value="4"> 4th Quarter </option>
			</select>
		</td>
	</tr>
	<tr>
		<td>IDC Type:</td>
		<td>
			<select id="idc_type" name="idc_type">
				<option value="construction">Contruction IDC</option>
				<option value="engineer">Architect-Engineer IDC</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Scope of Work</td>
		<td><textarea id="scope" name="scope"></textarea></td>
	<tr>
	<tr>
		<td>Awarded Contract Amount</td>
		<td><input type="text" id="award" name="award" value="<?=$_POST['award'];?>" /></td>
	</tr>
	
	<tr>
		<td>Commencement Date</td>
		<td><input type="text" id="commencement" name="commencement" value="<?=$_POST['commencement'];?>" /></td>
	</tr>
	<tr>
		<td>Expiration Date:</td>
		<td><input type="text" id="expiration" name="expiration" value="<?=$_POST['expiration'];?>" /></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" id="submit" name="submit" value="Submit IDC" />

<form>
</table>