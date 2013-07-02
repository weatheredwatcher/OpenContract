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

require('includes/db-include.php');
require('includes/globalinc.php');

$name = $_SESSION['name'];
$id = $_SESSION['id'];
$idc_id_internal = $_POST['idc_id_internal'];
$contractor = $_POST['contractor'];
$idc_type = $_POST['idc_type'];
$scope = $_POST['scope'];
$award = $_POST['award'];
$commencement = $_POST['commencement'];
$expiration = $_POST['expiration'];

if(isset($_POST['submit'])){

	      mysql_query("INSERT INTO tbl_idc (idc_id_internal, agency, contractor, idc_type, scope_of_work, award_Amount, commencement, expiration) VALUES ('$idc_id_internal', '$id', '$contractor', '$idc_type', '$scope', '$award', '$commencement', '$expiration')") or die(mysql_error());        
 		$_SESSION['extra'] = "agency=".$id.", contractor =".$contractor." award=".$award;
 		log_activity('idc');
      header("Location: main.php");
     } 

	

$title = "Agency Users";
$subtitle = "IDC Reporting";

// Probably will not needed.
//$docfunc = "/home/httpd/html/PS/ps-docmanV2-func.php";
//include($docfunc);

$header = "/home/httpd/html/PS/ps-header.php";
$footer = "/home/httpd/html/PS/ps-footer.php";
$links = "/home/httpd/html/PS/ps-links.php";


require($header);
?>
<link rel="stylesheet" type="text/css" media="all" href="js/datechooser/datechooser.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.3/jquery-ui.min.js"></script>
	 <style>
		.ui-dialog .ui-state-error { padding: .3em; }
		.validateTips { border: 1px solid transparent; padding: 0.3em; }
</style>
<script type="text/javascript" src="js/datechooser/datechooser.js"></script>
<script type="text/javascript">

		function FunctionEx6(objDate)
		{
			/*
			* This is the function that powers the datepicker.  To use it, the following class must be add
			* to each form field where the date picker is needed:
			* class="datechooser dc-dateformat='Y-m-d' dc-iconlink='js/datechooser/datechooser.png' dc-weekstartday='1' dc-onupdate='FunctionEx6'"
			*
			*/
			var ndExample5 = document.getElementById('datechooserex5');
			//ndExample5.DateChooser.setEarliestDate(objDate);
			ndExample5.DateChooser.updateFields();

			return true;
		}

	// -->
	</script>

<DIV id="contentwrap">
	<DIV id="sidebar">
	
	</DIV>	
<DIV id="ps-content">
	
	
<DIV style="margin-bottom: 15px; margin-top: 2px;"><h3> New IDC for the <?=$name;?> (<a href="logout.php">Log Out</a>)</h3></div>
	<DIV class="info_block">



<table>
<form method="post" action="add_idc.php" onsubmit="return validateForm()" name="add_idc">
	<tr>
		<td>IDC ID:</td>
		<td><input type="text" id="idc_id_internal" name="idc_id_internal" value="<?=$_POST['idc_id_internal'];?>" /></td>
		<td class="error"><span style="font-color: red; display: none;" id="year_err">*</span></td>
	</tr>
	<tr>
		<td>Contractor:</td>
		<td><input type="text" id="contractor" name="contractor" value="<?=$_POST['contractor'];?>" /></td>
		<td class="error"><span style="font-color: red; display: none;" id="year_err">*</span></td>
	</tr>
	
	<tr>
		<td>IDC Type:</td>
		<td>
			<select id="idc_type" name="idc_type">
				<option value="construction">Contruction IDC</option>
				<option value="engineer">Architect-Engineer IDC</option>
			</select>
		</td>
		<td class="error"><span style="font-color: red; display: none;" id="type_err">*</span></td>
	</tr>
	<tr>
		<td>Scope of Work</td>
		<td><textarea id="scope" name="scope"></textarea></td>
		<td class="error"><span style="font-color: red; display: none;" id="scope_err">*</span></td>
	<tr>
	<tr>
		<td>Awarded Contract Amount</td>
		<td><input type="text" id="award" name="award" onchange="onlynums(award);" value="<?=$_POST['award'];?>" /> (whole numbers only, no decimals!)</td>
		<td class="error"><span style="font-color: red; display: none;" id="amount_err">*</span></td>
	</tr>
	<tr>
		<td>Commencement Date</td>
		<td><input type="text" id="commencement" class="datechooser dc-dateformat='Y-m-d' dc-iconlink='js/datechooser/datechooser.png' dc-weekstartday='1' dc-onupdate='FunctionEx6'" name="commencement" value="<?=$_POST['commencement'];?>" /></td>
		<td class="error"><span style="font-color: red; display: none;" id="start_err">*</span></td>
	</tr>
	<tr>
		<td>Expiration Date:</td>
		<td><input type="text" id="expiration" name="expiration" class="datechooser dc-dateformat='Y-m-d' dc-iconlink='js/datechooser/datechooser.png' dc-weekstartday='1' dc-onupdate='FunctionEx6'" value="<?=$_POST['expiration'];?>" /></td>
		<td class="error"><span style="font-color: red; display: none;" id="end_err">*</span></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" id="submit" name="submit" value="Submit IDC" /><input type="button" value="Cancel" onClick="history.go(-1)"></td>
	</tr>	
<form>
</table>
</div>
</div>
</DIV>
<? require($footer);?>

<script type="text/javascript">

//setup all the variables for validation
		var contractor = $("#contractor"),
			scope = $("#scope"),
			commencement = $("#commencement"),
			expiration = $("#expiration"),
			amount = $("#amount");
			var allFields = $( [] ).add( contractor ).add( scope ).add( commencement ).add( expiration ).add( amount );
			var tips = $( ".validateTips" );
		
	//start validation funciton:
	function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}
	
	function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );
				alert( "Length of " + n + " must be between " +
					min + " and " + max + "." );
				return false;
			} else {
				return true;
			}
		}

function validateDate(txtDate){

	var txtDate = txtDate
	var filter = new RegExp("((((19|20)(([02468][048])|([13579][26]))-02-29))|((20[0-9][0-9])|(19[0-9][0-9]))-((((0[1-9])|(1[0-2]))-((0[1-9])|(1[[0-9]])|(2[0-8])))|((((0[13578])|(1[02]))-31)|(((0[1,3-9])|(1[0-2]))-(29|30)))))");
	if(filter.test(txtDate)){
		alert ("Validated");
		return true;}
	else {
		alert("Date must be in the format of 'YYYY-MM-DD'");
		return false;
}
}



function validateForm(){

var contractor = $("#contractor"),
			scope = $("#scope"),
			commencement = $("#commencement").val(),
			expiration = $("#expiration").val(),
			amount = $("#amount");
			var allFields = $( [] ).add( contractor ).add( scope ).add( commencement ).add( expiration ).add( amount );
			var tips = $( ".validateTips" );

var bValid = true;
					allFields.removeClass("ui-state-error");
					bValid = bValid && checkLength(contractor, "Contractor", 1, 255);
					bValid = bValid && checkLength(scope, "Scope", 3, 255);
					bValid = bValid && checkLength(amount, "Amount", 1, 999999);
					bValid = bValid && validateDate(commencement);
					bValid = bValid && validateDate(expiration);
					
										
					if(bValid){ 
						return true; } else {return false;}


}



function onlynums(e){
//e.value=e.value.replace("[.0]+$", "", '');
e.value=e.value.replace(/\D/g,'');
}

//str.replaceAll("[.0]+$", "");

</script>