<?php
/**
*
*  This is the testing file to load DO's into the system one at a time, or in bulk via csv files.
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

	if($_POST['date'] == ""){ $msg .="[Date can't be empty]"; $err_check++;} 
	if($_POST['do_id'] == ""){ $msg .="[DO Number can't be empty]"; $err_check++;} 
	if($_POST['description'] == ""){ $msg .="[Project Name can't be empty]"; $err_check++;} 
	if($_POST['basic'] == ""){ $msg .="[Basic Service Fee can't be empty]"; $err_check++;} 
	if($_POST['additional'] == ""){ $msg .="[Additional Fees can't be empty]"; $err_check++;} 
	if($_POST['reimbursed'] == ""){ $msg .="[Reimbursed Fees can't be empty]"; $err_check++;} 
	
    if($err_check == 0){ $msg.= "Thanks for submiting an IDC!"; } //todo: if error count is zero, we write to the database

	$msg .="</div>";
}
?>
<html>
<head>
	<title> DOS Submit Form </title>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js"></script>
	 <SCRIPT language="javascript">
	 var i = 0;
		function addRow(tableID) {
			i++;
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type = "checkbox";
			cell1.appendChild(element1);

			var cell2 = row.insertCell(1);
			var element2 = document.createElement("input");
			element2.type = "text";
			element2.name = "date" + i;
			element2.id = "date" + i;
			cell2.appendChild(element2);

			var cell3 = row.insertCell(2);
			var element3 = document.createElement("input");
			element3.type = "text";
			element3.name = "do_id" + i;
			element3.id = "do_id" + i;
			cell3.appendChild(element3);

			var cell4 = row.insertCell(3);
			var element4 = document.createElement("input");
			element4.type = "text";
			element4.name = "description" + i;
			element4.id = "description" + i;
			cell4.appendChild(element4);

			var cell5 = row.insertCell(4);
			var element5 = document.createElement("input");
			element5.type = "text";
			element5.name = "basic" + i;
			element5.id = "basic" + i;
			cell5.appendChild(element5);

			var cell6 = row.insertCell(5);
			var element6 = document.createElement("input");
			element6.type = "text";
			element6.name = "additional" + i;
			element6.id = "additional" + i;
			cell6.appendChild(element6);

			var cell7 = row.insertCell(6);
			var element7 = document.createElement("input");
			element7.type = "text";
			element7.name = "reimbursed" + i;
			element7.id = "reimbursed" + i;
			cell7.appendChild(element7);

		}

		function deleteRow(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
				if(null != chkbox && true == chkbox.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}


			}
			}catch(e) {
				alert(e);
			}
		}

	</SCRIPT>
</head>
<body>
<h1>Delivery Order (DO) Submit Form (TESTING)</h1>

<?=$msg;?>

	<input type="button" value="Add Row" onclick="addRow('dataTable')" />
 	<input type="button" value="Delete Row" onclick="deleteRow('dataTable')" />

<table border="1" id="dataTable">
	<form method="post" action="load_dos.php">
	<tr class="data_row">
		<th>Sel</th>
		<th>Delivery Order Date:</th>
		<th>DO Number:</th>
		<th>Project Name</th>
		<th>Basic Service Fees</th>
		<th>Additional Fees</th>
		<th>Reimbursed Fees</th>
	</tr>


	<tr>
		<td><input type="checkbox" name="chk"/></td>
		<td><input type="text" id="date" name="date" value="<?=$_POST['date'];?>" /></td>
		<td><input type="text" id="do_id" name="do_id" value="<?=$_POST['do_id'];?>" /></td>
		<td><input type="text" id="description" name="description" value="<?=$_POST['do_id'];?>" /></td>
		<td><input type="text" id="basic" name="basic" value="<?=$_POST['basic'];?>" /></td>
		<td><input type="text" id="additional" name="additional" value="<?=$_POST['additional'];?>" /></td>
		<td><input type="text" id="reimbursed" name="reimbursed" value="<?=$_POST['reimbursed'];?>" /></td>
	</tr>
	
	
		
</table>		
<input type="submit" id="submit" name="submit" value="Submit IDC" />
</form>

</body>
</html>
<?php

print_r($_POST);

?>