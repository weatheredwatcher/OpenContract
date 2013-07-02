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
require('config.php');
require('includes/globalinc.php');

$idc_id = $_GET['id'];
$_SESSION['idc_id'] = $idc_id;
$name = $_SESSION['name'];
$id = $_SESSION['id'];
$current_page = $_SERVER["PHP_SELF"].'?id='.$idc_id;

$startDate = f_getStartDate();
$endDate = f_getEndDate();

	$query="SELECT * FROM tbl_idc WHERE id = '$idc_id'";
	$results = mysql_query($query) or die(mysql_error());

	
	while($row = mysql_fetch_assoc($results)):
		$contractor = $row['contractor'];
		$year = $row['year'];
	    $quarter = $row['quarter'];
	    $idc_type = $row['idc_type'];
	    $scope = $row['scope_of_work'];
	    $award = $row['award_Amount'];
	    $sum = $row['sum_all_dos'];
	    $contract = $row['contract_balance'];
	    $totals = get_do_totals($idc_id);
	    $current = $award - $totals;
	    $total_reimbursed = get_do_reimbursements($idc_id);
	    $commencement = $row['commencement'];
   		$expiration = $row['expiration'];

	endwhile; 

	$query2="SELECT * FROM tbl_dos WHERE idc_id = '$idc_id' AND timestamp between '$startDate' and '$endDate' ORDER BY do_id, order_date";
	
	$results2 = mysql_query($query2) or die(mysql_error());

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
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" media="all" href="js/datechooser/datechooser.css">
<style>
		.ui-dialog .ui-state-error { padding: .3em; }
		.validateTips { border: 1px solid transparent; padding: 0.3em; }
</style>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.3/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-modal.js"></script>
<script type="text/javascript" src="js/datechooser/datechooser.js"></script>

	<script type="text/javascript">
//events.add(window, 'load', WindowLoad);

		function WindowLoad()
		{
var ndExample1 = document.getElementById('date');
			ndExample1.DateChooser = new DateChooser();

			// Check if the browser has fully loaded the DateChooser object, and supports it.
			if (!ndExample1.DateChooser.display)
			{
				return false;
			}

			ndExample1.DateChooser.setCloseTime(200);
			ndExample1.DateChooser.setXOffset(10);
			ndExample1.DateChooser.setYOffset(-10);
			ndExample1.DateChooser.setUpdateFunction(FunctionEx1);
			document.getElementById('datelinkex1').onclick = ndExample1.DateChooser.display;
}

	$(document).ready(function() {
	//setup all the variables for validation
		var date = $("#date"),
			do_id = $("#do_id"),
			pro_name = $("#pro_name"),
			basic = $("#basic");
			var allFields = $( [] ).add( date ).add( do_id ).add( pro_name ).add( basic );
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

		
		$('#do_id').blur(function(){

			if(!document.getElementById('amendment').checked){
					$.ajax({
	  					url: 'includes/check_do.php?id=' + document.getElementById('do_id').value,
	  					dataType: 'text',
	  					success: function(data) { 
	  						if(data){ 
		  						amend_check=confirm("This DO matches one or more DO's already in the system.  Is this an amendment?");
		  						
		  						if(amend_check){
	  								document.getElementById('amendment').checked=true;
	  								
	  								
		  						}
		  						else{ 	document.getElementById('amendment').checked=false;
		  								document.getElementById('do_id').value="";
		  								
		  								
		  							}
	  					}
	  						
	  					 }

	    					
					});
				} 


		});
		 
		$("#dialog-form").dialog({
			autoOpen: false,
			height: 400,
			width: 500,
			modal: true,
			buttons: {
				"OK": function(){
					var bValid = true;
					allFields.removeClass("ui-state-error");
					
					bValid = bValid && checkLength(date, "Date", 10, 10);
					bValid = bValid && checkLength(do_id, "DO ID", 3, 255);
					bValid = bValid && checkLength(pro_name, "Project Name", 1, 255);
					bValid = bValid && checkLength(basic, "Fee", 1, 999999);
					




					
					if(bValid){
					form_data = $('#do').serialize();
					
					$.ajax({
	  					url: 'do_functions.php?id=' + $('#row_id').val(),
	  					dataType: 'text',
	  					data: form_data,
	  					success: function(data) { 

	  						alert(data);
	  						location.reload();
	  					 }

					});
					
					
					$( this ).dialog( "close" );
					}
					

				},
				Close: function(){
					$('#date').val("");
					$('#do_id').val("");
					$('#pro_name').val("");
					$('#basic').val("");
					$('#reimbursed').val("");
				$( this ).dialog( "close" );
				}
			},
			close: function(){}
		}); //end of dialog box

		$("#dialog-text").dialog({
			autoOpen: false,
			height: 340,
			width: 400,
			modal: true,
			buttons: {
				"Close IDC": function(){
					var quarter = $("#quarter").val();
					if($("#close-idc").val() == ""){
						alert("Must enter your ititials!");}
					else{
						//here we submit the data to the remote 
						$.ajax({
		  					url: 'submit_cert.php?id=' + <?=$idc_id;?> + '&cert=' + $('#close-idc').val() + '&quarter=' + quarter,
		  					dataType: 'text',
		  					success: function(data) { 

		  						location.reload();
		  					 }

						});

						}
					
				},
				Cancel: function(){
				$( this ).dialog( "close" );
				}
			},
			close: function(){}
		}); //end of second dialog

		$('#close_idc').click(function() {
			$("#dialog-text").dialog('open');
			// prevent the default action, e.g., following a link
			return false;
		});

		$('#opener').click(function() {
			$("#factory").val("insert");
			$("#dialog-form").dialog('open');
			// prevent the default action, e.g., following a link
			return false;
		});

		$('.edit').click(function() {
			var do_id = this.title;

			$.ajax({
				url: 'grab_update.php?do_id=' + this.title,
				//dataType: 'text',
				success: function(data) { 

					var obj = eval('(' + data + ')');
					var row_id = this.title;
						$("#date").val(obj.order_date);
						$("#do_id").val(obj.do_id);
						$("#pro_name").val(obj.pro_name);
						$("#basic").val(obj.basic);
						$("#reimbursed").val(obj.reimbursed);
						if(obj.amendment  == 1){$("#amendment").checked = true;}
						
								
					
				 }

		});
			$("#factory").val("update");
			$("#dialog-form").dialog('open');
			// prevent the default action, e.g., following a link
			return false;
		});

		$('.delete').click(function() {

			$.ajax({
					url: 'do_functions.php?factory=delete&do_id=' + this.title,
					dataType: 'text',
					success: function(data) { 
					
					location.reload();
						
						
					 }

			});
			// prevent the default action, e.g., following a link
			return false;
		});
	});
	</script>


<script type="text/javascript">

		function FunctionEx6(objDate)
		{
			/*
			* This is the function that powers the datepicker.  To use it, the following class must be add
			* to each form field where the date picker is needed:
			* class="datechooser dc-dateformat='Y-m-d' dc-iconlink='js/datechooser/datechooser.png' dc-weekstartday='1' dc-onupdate='FunctionEx6'"
			*
			*/
			var objEarlyDate = new Date();
			objEarlyDate.setMonth(objEarlyDate.getMonth());
			var objLatestDate = new Date();
			//objLateDate.setMonth(objLateDate.getMonth() + 1);

			var ndExample5 = document.getElementById('date');
			ndExample5.DateChooser.setEarliestDate(objEarlyDate);
			//ndExample5.DateChooser.setLatestDate(objLateDate);
			ndExample5.DateChooser.updateFields();

			return true;
		}
</script>

<script type="text/javascript">


        function checkAmend(){

			//here we check to see if this could be an amendment.
			if (document.getElementById('do_id').value == ""){ 
				alert('Sorry, you must use the SAME DO/WO id as the DO/WO you wish to ammend!');
				document.getElementById('amendment').checked=false;
			//end of if
			} else {

				$.ajax({
  					url: 'includes/check_do.php?id=' + document.getElementById('do_id').value,
  					dataType: 'text',
  					success: function(data) { 
  						if(!data){ alert("Sorry, you must use the SAME DO/WO id as the DO/WO you wish to ammend!");
  						document.getElementById('amendment').checked=false;
  						document.getElementById('do_id').value="";
  					}
  						
  					 }

    					
				});
			} //end of else


		//end of script
	}
 
</script>

<DIV id="contentwrap">
	<DIV id="sidebar">
	<!--todo: check dates and figure out how many open qrt's we can close -->
	<a class="btn" name="close_idc" id="close_idc" href="#">Close IDC</a>
	
	

	</DIV> 	
<DIV id="ps-content">
	
	
<DIV style="margin-bottom: 15px; margin-top: 2px;"><h3>IDC's for the <?=$name;?> (<a href="logout.php">Log Out</a>)</h3></div>
	<DIV>

<?=$msg;?>

<table id="idc_table">

	<tr>
		<td>Contractor:</td>
		<td><?=$contractor;?></td>
	</tr>
	<tr>
		<td>Quarter </td>
		<td><?=get_quarter_range(date('M'));?></td>
		
	</tr>
	<tr>
		<td>IDC Type:</td>
		<td id="idc_type">
			<?=$idc_type;?>
		</td>
	</tr>
	<tr>
		<td>Scope of work:</td>
		<td><?=$scope;?></td>
	<tr>
	<tr>
		<td>Awarded contract amount:</td>
		<td><?=money_format('%(#10n', $award);?></td>
	</tr>
	<tr>
		<td>Contract balance end of previous quarter</td>
		<td><?=money_format('%(#10n', $award - get_do_totals_previous($idc_id))?></td>
	</tr>
	<tr>
		<td>Sum of DO's issued through end of previous quarter:</td>
		<td><?=money_format('%(#10n', get_do_totals_previous($idc_id))?></td>
	
	
	<tr>
		<td>Sum of DO's this quarter:</td>
		<td><?=money_format('%(#10n', $totals);?></td>
	</tr>
	
	<tr>
		<td>Sum of Reimbursement's this quarter:</td>
		<td><?=money_format('%(#10n', $total_reimbursed);?></td>
	</tr>
	<tr>
		<td>Contract balance (as of <?=date('Y-m-d');?>)</td>
		<td><? if($current < 1000): ?> <strong style="color:red"><?=money_format('%(#10n', $current);?> <i class="icon-exclamation-sign"></i> </strong>
		
			<? else:?>
			<?=money_format('%(#10n', $current);?>
			<? endif?></td>
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

<table border="1" id="dataTable1" width="100%">
	
	<tr class="data_row">
		
		<th>Delivery Order Date:</th>
		<th>DO Number:</th>
		<th>Project Name</th>
		<th>Cost/Fee</th>
		<th>Reimbursed Fees</th>
		<th>Amendment Y/N</th>
	</tr>

<? while($row2 = mysql_fetch_assoc($results2)): ?>


	<tr id = <?=$row2['id'];?>>
		<td><?=$row2['order_date'];?></td>
		<td><?=$row2['do_id'];?></td>
		<td><?=$row2['pro_name'];?></td>
		<td><?=money_format('%(#10n', $row2['basic']);?></td>
		<td><?=money_format('%(#10n', $row2['reimbursed']);?></td>
		<td><? if ($row2['amendment'] == 0): echo "No"; else:  echo "Yes"; endif; ?></td>
		<td width="130"><a class="btn btn-info edit" title="<?=$row2['id'];?>" href="#"><i class="icon-pencil icon-white"></i> Edit<a/> <a class="btn btn-danger delete" title="<?=$row2['id'];?>" href="#"><i class="icon-trash icon-white"></i></a></td>
	</tr>

<input type="hidden" name="row_id" id="row_id" value="<?=$row2['id'];?>">
	<? endwhile; ?>	


</table>	
<table>	
	<tr>
		<td><button id="opener" class="btn"><i class="icon-plus-sign"></i>Add Do</button></td>
		<td><a class="btn" href="upload_dos.php"><i class="icon-folder-open"></i> Batch Upload DO's</a></td>
		<td><input type="button" class="btn" value="Cancel" onClick="window.location.href='main.php';"></td>
	</tr>
	</table>

</div>
</div>
</DIV>

<br />
<div id="dialog-form" title="Create/Edit New DO">
<form id="do">
	<h2> Create/Edit New DO</h2>
<table border="0" id="dataTable">
	
	<tr>
		<td>Delivery Date:</td>
		<td><input type="text" id="date" name="date" class="datechooser dc-dateformat='Y-m-d' dc-iconlink='js/datechooser/datechooser.png' dc-weekstartday='1' dc-latestdate='<?=getEndDate();?>' dc-earliestdate='<?=getStartDate();?>' dc-onupdate='FunctionEx6'" value="<?=$_POST['date'];?>" /></td>
	</tr>
	<tr>
		<td>DO Number:</td>
		<td><input type="text" id="do_id" name="do_id" value="" /></td>
	</tr>
	<tr>
		<td>Project Name:</td>
		<td><input type="text" id="pro_name" name="pro_name" value="<?=$_POST['do_id'];?>" /></td>
	</tr>
	<tr>
		<td>Cost/Fee*</td>
		<td><input type="text" id="basic" name="basic" onchange="onlynums(basic);" value="<?=$_POST['basic'];?>" /></td>
	</tr>
	<tr>
		<td>Reimbursed Fee*</td>
		<td><input type="text" id="reimbursed" name="reimbursed" onchange="onlynums(reimbursed);" value="<?=$_POST['reimbursed'];?>" /></td>
	</tr>
	<tr>
		<td><lable name="amendment">Amendment:<input type="checkbox" id="amendment" name="amendment" onClick="checkAmend()" /></label>
	</tr>
	<tr><td span="2">*Whole numbers only, no decimals!</td></tr>
	<input type="hidden" name="factory" id="factory" value="">
	
</form>
</table>

</div>

<div id="dialog-text" title-"Close IDC">
<div class="alert alert-info"><h2>Warning!</h2>
<p>Once you close out an IDC you are certifying that is is correct and ready for auditing, to the best pf your knowledge.</p>
<p>To certify that this IDC is correct, please enter your initials in the field provided and close the idc.</p>
</div>
<?
$query = mysql_query("SELECT * FROM tbl_dos WHERE idc_id='$idc_id'");
$count_dos = mysql_affected_rows();
if($count_dos == 0) {
	
	echo('<div class="alert alert-error">This IDC does not have any activity for this quarter.</div>');
}
?>

<form >
	<table border=0>
		<tr>
<td>Fiscal Year</td><td><select name="wqarter" id="quarter">
	<option><?=previous_quarter(date());?></option>
	<option><?=current_quarter(date());?></option>
	</td></tr>
<tr><td>Initials</td><td><input id="close-idc" type="text" class="span3" placeholder="Enter your initials..." /></td></tr>
</table>


</form>
</div>


<script type="text/javascript">
if($.trim(document.getElementById('idc_type').innerHTML) == "construction"){

	document.getElementById('reimbursed').disabled=true;
	
}

function onlynums(e){
//e.value=e.value.replace("[.0]+$", "", '');
e.value=e.value.replace(/\D/g,'');
}

</script>
<? require($footer);?>