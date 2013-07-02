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
$idc_id = $_GET['dos'];

//$startDate = f_getStartDate();
//$endDate = f_getEndDate();

	$query="SELECT * FROM tbl_idc WHERE idc_id_internal = '$idc_id'";
	$results = mysql_query($query) or die(mysql_error());


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


<DIV id="contentwrap">
	<DIV id="sidebar">
	<!--todo: check dates and figure out how many open qrt's we can close -->
	<a class="btn" name="close_idc" id="close_idc" href="#">Close IDC</a>
	
	

	</DIV> 	
<DIV id="ps-content">
	
	
<DIV style="margin-bottom: 15px; margin-top: 2px;"><h3>IDC's for the <?=$name;?> (<a href="logout.php">Log Out</a>)</h3></div>
	<DIV>

<?=$msg;?>

<? while($row = mysql_fetch_assoc($results)):
		$idc_id = $row['id'];
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
   		$expiration = $row['expiration']; ?>

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
<? $query2="SELECT * FROM tbl_dos WHERE idc_id = '$idc_id' ORDER BY do_id, order_date";
	
	$results2 = mysql_query($query2) or die(mysql_error());

 while($row2 = mysql_fetch_assoc($results2)): ?>


	<tr id = <?=$row2['id'];?>>
		<td><?=$row2['order_date'];?></td>
		<td><?=$row2['do_id'];?></td>
		<td><?=$row2['pro_name'];?></td>
		<td><?=money_format('%(#10n', $row2['basic']);?></td>
		<td><?=money_format('%(#10n', $row2['reimbursed']);?></td>
		<td><? if ($row2['amendment'] == 0): echo "No"; else:  echo "Yes"; endif; ?></td>
	</tr>

<input type="hidden" name="row_id" id="row_id" value="<?=$row2['id'];?>">
	<? endwhile; ?>	


</table>	



<? endwhile; ?>
<br />
<br />

</div>
</div>
</DIV>


<? require($footer);?>