<?php
/**
*
*  This is the main page where we load the IDC's
*
*
*
*/

session_start();
ini_set('display_errors','On'); 
include('includes/testing-include.php');
require('includes/db-include.php');
require('includes/globalinc.php');

$name = $_SESSION['name'];
$id = $_SESSION['id'];

$results = mysql_query("SELECT * FROM tbl_idc WHERE agency = '$id'");
<script>
$("#dialog-form").dialog({
			autoOpen: false,
			height: 200,
			width: 1260,
			modal: true,
			buttons: {
				"OK": function(){
					var bValid = true;
					allFields.removeClass("ui-state-error");
					
					bValid = bValid && checkLength(date, "Date", 10, 10);
					bValid = bValid && checkLength(do_id, "DO ID", 3, 255);
					bValid = bValid && checkLength(pro_name, "Project Name", 1, 255);
					bValid = bValid && checkLength(basic, "Fee", 1, 999999);
					




					
					if(bValid){console.log($('#do').serialize());
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
					
					console.log('added do');
					$( this ).dialog( "close" );
					}
					

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

</script>

?>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	
		

<h3> IDC's for the <?=$name;?></h3>

	<table border="1">
		<tr>
			<th>IDC ID</th><th>Year</th><th>Quarter</th><th>Type</th><th>Scope</th><th>Action</th>
		</tr>
		<?php while($row = mysql_fetch_assoc($results)): ?>

			<tr>
				<td><?=$row['id'];?></td>
				<td><?=$row['year'];?></td>
				<td><?=$row['quarter'];?></td>
				<td><?=$row['idc_type'];?></td>
				<td><?=$row['scope_of_work'];?></td>
				<td> Edit &nbsp;| &nbsp; <a href="" id="opener">View</a> &nbsp;| &nbsp;Delete</td></tr>
		
	<?php endwhile; ?>
	</table>
	<a class="btn" href="add_idc.php">Add New IDC</a>


	<div id="dialog-form" title-"View IDC">
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
		<td>Scope of Work</td>
		<td><?=$scope;?></td>
	<tr>
	<tr>
		<td>Awarded Contract Amount</td>
		<td><?=money_format('%(#10n', $award);?></td>
	</tr>
	<tr>
		<td>Sum of All delivery orders issued through end of previous quarter:</td>
		<td><?=$sum?></td>
	<tr>
		<td>Contract balance (end of previous quarter)</td>
		<td><?=$contract;?></td>
	</tr>
	<tr>
		<td>Contract Balance (end this quarter):</td>
		<td><? if($current < 1000): ?> <strong style="color:red"><?=money_format('%(#10n', $current);?> <i class="icon-exclamation-sign"></i> </strong>
		
			<? else:?>
			<?=money_format('%(#10n', $current);?>
			<? endif?></td>
	</tr>
	<tr>
		<td>Current Spending (end this quarter, with reimbursements):</td>
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


    </div>

	</body>
</html>