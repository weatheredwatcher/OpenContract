<?php
/**
*
*  This is the testing file to load IDC's into the system one at a time, or in bulk via csv files.
*  @author David Duggins <weatheredwatcher@gmail.com>
*  @version 0.1a
*  @package IDC System
*/
require("includes/db-include.php");
require("includes/testing-include.php");
//checks for sumbission
if(isset($_POST['submit'])){

	//submit the form data to the database
	$msg = "<div style='width:600px; height:100px; background-color:pink; opacity:1; color: black;'>";
	$err_check = 0;  //counts the errors in the form
	//server-side validation

	if($_POST['agency'] == ""){ $msg .="[Agency can't be empty]"; $err_check++;} 
	if($_POST['year'] == ""){ $msg .="[Year can't be empty]"; $err_check++;} 
	if($_POST['scope'] == ""){ $msg .="[Scope can't be empty]"; $err_check++;} 
	if($_POST['award'] == ""){ $msg .="[Award can't be empty]"; $err_check++;} 
	if($_POST['sum'] == ""){ $msg .="[Sum can't be empty]"; $err_check++;} 
	if($_POST['contract'] == ""){ $msg .="[Contract Balance can't be empty]"; $err_check++;} 
	if($_POST['current'] == ""){ $msg .="[Contract Balance can't be empty]"; $err_check++;} 
	if($_POST['commencement'] == ""){ $msg .="[Commencement Date can't be empty]"; $err_check++;} 
	if($_POST['expiration'] == ""){ $msg .="[Expiration Date can't be empty]"; $err_check++;}

    if($err_check == 0){ $msg.= "Thanks for submiting an IDC!"; } //todo: if error count is zero, we write to the database

	$msg .="</div>";
}
?>
<h1>IDC Submit Form (TESTING)</h1>

<?=$msg;?>

<table>
<form method="post" action="load_idc.php">
	<tr>
		<td>Agency Number:</td>
		<td><input type="text" id="agency" name="agency" value="<?=$_POST['agency'];?>" /></td>
	</tr>
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
		<td>Sum of All delivery orders issued through end of previous quarter:</td>
		<td><input type="text" id="sum" name="sum" value="<?=$_POST['sum'];?>" /></td>
	<tr>
		<td>Contract balance (end of previous quarter:)</td>
		<td><input type="text" id="contract" name="contract" value="<?=$_POST['contract'];?>" /></td>
	</tr>
	<tr>
		<td>Contract Balance (end this quarter):</td>
		<td><input type="text" id="current" name="current" value="<?=$_POST['current'];?>" /></td>
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