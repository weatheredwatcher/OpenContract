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

//ini_set('display_errors','On'); 
include('includes/testing-include.php');
require('includes/db-include.php');
require('includes/globalinc.php');

$idc_id = $_GET['id'];
$name = $_SESSION['name'];
$id = $_SESSION['id'];
$current_page = $_SERVER["PHP_SELF"].'?id='.$idc_id;
if(isset($_POST['submit'])){
//submit the form data to the database
	$msg = "<div style='width:600px; height:100px; background-color:pink; opacity:1; color: black;'>";
	$err_check = 0;  //counts the errors in the form
	//server-side validation

	if($_POST['date'] == ""){ $msg .="[Date can't be empty]"; $err_check++;} 
	if($_POST['do_id'] == ""){ $msg .="[DO Number can't be empty]"; $err_check++;} 
	if($_POST['pro_name'] == ""){ $msg .="[Project Name can't be empty]"; $err_check++;} 
	if($_POST['basic'] == ""){ $msg .="[Basic Service Fee can't be empty]"; $err_check++;} 
	if($_POST['additional'] == ""){ $msg .="[Additional Fees can't be empty]"; $err_check++;} 
	if($_POST['reimbursed'] == ""){ $msg .="[Reimbursed Fees can't be empty]"; $err_check++;} 
	
    if($err_check == 0){ 
    	$date = mysql_escape_string($_POST['date']);
    	$do_id = mysql_escape_string($_POST['do_id']);
    	$pro_name = mysql_escape_string($_POST['pro_name']);
    	$basic = mysql_escape_string($_POST['basic']);
    	$additional = mysql_escape_string($_POST['additional']);
    	$reimbursed = mysql_escape_string($_POST['reimbursed']);
    	
    	mysql_query("INSERT INTO tbl_dos (idc_id, order_date, do_id, pro_name, basic, additional, reimbursed) VALUES ('$idc_id', '$date', '$do_id', '$pro_name', '$basic', '$additional', '$reimbursed')") or die(mysql_error());

     } //todo: if error count is zero, we write to the database

	$msg .="</div>";




}

	$query="SELECT * FROM tbl_idc WHERE id = '$idc_id'";
	$results = mysql_query($query) or die(mysql_error());

	while($row = mysql_fetch_assoc($results)):

		$year = $row['year'];
	    $quarter = $row['quarter'];
	    $idc_type = $row['idc_type'];
	    $scope = $row['scope_of_work'];
	    $award = $row['award_amount'];
	    $sum = $row['sum_all_dos'];
	    $contract = $row['contract_balance'];
	    $current = $row['current_balance'];
	    $commencement = $row['commencement'];
   		$expiration = $row['expiration'];

	endwhile; 

	$query2="SELECT * FROM tbl_dos WHERE idc_id = '$idc_id'";
	$results2 = mysql_query($query2) or die(mysql_error());
?>

<h3>IDC for the <?=$name;?> </h3>

<?=$msg;?>

<table>

	<tr>
		<td>Calendar Year:</td>
		<td><?=$year;?></td>
	</tr>

	<tr>
		<td>Quarter </td>
		<td><?=$quarter;?></td>
		
	</tr>
	<tr>
		<td>IDC Type:</td>
		<td>
			<?=$idc_type;?>
		</td>
	</tr>
	<tr>
		<td>Scope of Work</td>
		<td><?=$scope;?></td>
	<tr>
	<tr>
		<td>Awarded Contract Amount</td>
		<td><?=$award;?></td>
	</tr>
	<tr>
		<td>Sum of All delivery orders issued through end of previous quarter:</td>
		<td><?=$sum?></td>
	<tr>
		<td>Contract balance (end of previous quarter:)</td>
		<td><?=$contract;?></td>
	</tr>
	<tr>
		<td>Contract Balance (end this quarter):</td>
		<td><?=$current;?></td>
	</tr>
	<tr>
		<td>Commencement Date</td>
		<td><?=$commencement;?></td>
	</tr>
	<tr>
		<td>Expiration Date:</td>
		<td><?=$expiration;?></td>
	</tr>
	<tr>
</table>

<table border="1" id="dataTable1">
	
	<tr class="data_row">
		
		<th>Delivery Order Date:</th>
		<th>DO Number:</th>
		<th>Project Name</th>
		<th>Basic Service Fees</th>
		<th>Additional Fees</th>
		<th>Reimbursed Fees</th>
	</tr>

<? while($row2 = mysql_fetch_assoc($results2)): ?>


	<tr>
		<td><?=$row2['order_date'];?></td>
		<td><?=$row2['do_id'];?></td>
		<td><?=$row2['pro_name'];?></td>
		<td><?=$row2['basic'];?></td>
		<td><?=$row2['additional'];?></td>
		<td><?=$row2['reimbursed'];?></td>
	</tr>
	
	
	<? endwhile; ?>	
</table>		


<br />

<table border="1" id="dataTable">
	<form method="post" action="<?=$current_page;?>">
	<tr class="data_row">
		
		<th>Delivery Order Date:</th>
		<th>DO Number:</th>
		<th>Project Name</th>
		<th>Basic Service Fees</th>
		<th>Additional Fees</th>
		<th>Reimbursed Fees</th>
	</tr>


	<tr>
		
		<td><input type="text" id="date" name="date" value="<?=$_POST['date'];?>" /></td>
		<td><input type="text" id="do_id" name="do_id" value="<?=$_POST['do_id'];?>" /></td>
		<td><input type="text" id="pro_name" name="pro_name" value="<?=$_POST['do_id'];?>" /></td>
		<td><input type="text" id="basic" name="basic" value="<?=$_POST['basic'];?>" /></td>
		<td><input type="text" id="additional" name="additional" value="<?=$_POST['additional'];?>" /></td>
		<td><input type="text" id="reimbursed" name="reimbursed" value="<?=$_POST['reimbursed'];?>" /></td>
	</tr>
	
	
		
</table>		
<input type="submit" id="submit" name="submit" value="Submit DO" />
</form>