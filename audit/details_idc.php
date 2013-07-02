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
require('../config.php');
require('../includes/globalinc.php');

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
	    $total_reimbursed = $totals + get_do_reimbursements($idc_id);
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
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" media="all" href="../js/datechooser/datechooser.css">
<style>
		.ui-dialog .ui-state-error { padding: .3em; }
		.validateTips { border: 1px solid transparent; padding: 0.3em; }
</style>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.3/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap-modal.js"></script>
<script type="text/javascript" src="../js/datechooser/datechooser.js"></script>

	<script type="text/javascript">

	$(document).ready(function() {
		$("#dialog-form").dialog({
			autoOpen: false,
			height: 200,
			width: 400,
			modal: true,
			buttons: {
				"OK": function(){
					
					
					$.ajax({
	  					url: 'sign-off.php?id=' + $('#row_id').val(),
	  					dataType: 'text',
	  					success: function(data) { 

	  						alert(data);
	  						location.reload();
	  					 }

					});
										
					$( this ).dialog( "close" );
					
				},
				Close: function(){
					
				$( this ).dialog( "close" );
				}
			},
			close: function(){}
		}); //end of dialog box

		

		$('#opener').click(function() {
		
			$("#dialog-form").dialog('open');
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
		<td>Fiscal Year:</td>
		<td><?=$fiscalyear;?></td>
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
		<td>Sum of DO's issued through end of <?=previous_quarter();?>:</td>
		<td><?=money_format('%(#10n', get_do_totals_previous($idc_id))?></td>
	<tr>
		<td>Contract balance (end of <?=previous_quarter();?>)</td>
		<td><?=money_format('%(#10n', $award - get_do_totals_previous($idc_id))?></td>
	</tr>
	<tr>
		<td>Contract balance (as of <?=date('Y-m-d');?>)</td>
		<td><? if($current < 1000): ?> <strong style="color:red"><?=money_format('%(#10n', $current);?> <i class="icon-exclamation-sign"></i> </strong>
		
			<? else:?>
			<?=money_format('%(#10n', $current);?>
			<? endif?></td>
	</tr>
	<tr>
		<td>Current Spending (w/o reimbursements):</td>
		<td><?=money_format('%(#10n', $totals);?></td>
	</tr>
	
	<tr>
		<td>Current Spending (with reimbursements):</td>
		<td><?=money_format('%(#10n', $total_reimbursed);?></td>
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
		<th>Basic Service Fees</th>
		<th>Reimbursed Fees</th>
		<th>Amendment Y/N</th>
		<th>OSE Verified</th>
	</tr>

<? while($row2 = mysql_fetch_assoc($results2)): ?>


	<tr id = <?=$row2['id'];?>>
		<td><?=$row2['order_date'];?></td>
		<td><?=$row2['do_id'];?></td>
		<td><?=$row2['pro_name'];?></td>
		<td><?=money_format('%(#10n', $row2['basic']);?></td>
		<td><?=money_format('%(#10n', $row2['reimbursed']);?></td>
		<td><? if ($row2['amendment'] == 0): echo "No"; else:  echo "Yes"; endif; ?></td>
		<td>
			<?php 
			if(strlen($row2['ose_verify']) != 0):
				echo $row2['ose_verify'];

			else:
				echo ('<button id="opener" class="btn"><i class="icon-edit"></i>Sign Off</button>');

			endif; ?>
		</td>
	</tr>

<input type="hidden" name="row_id" id="row_id" value="<?=$row2['id'];?>">
	<? endwhile; ?>	


</table>	
<table>	
	<tr>
		
		<td><input type="button" class="btn" value="Cancel" onClick="window.location.href='main.php';"></td>
	</tr>
	</table>

</div>
</div>
</DIV>

<br />
<div id="dialog-form" title="Sign off on DO">
<form id="do">
	<h2> Sign Off on DO</h2>
<p> <?=$name;?>, you are about to sign off on a DO.</p>
<p>Please make sure that you are sure</p>
</div>



<script type="text/javascript">
if($.trim(document.getElementById('idc_type').innerHTML) == "construction"){

	document.getElementById('reimbursed').disabled=true;
	
}

</script>
<? require($footer);?>