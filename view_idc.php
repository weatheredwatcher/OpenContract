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
$name = $_SESSION['name'];
$id = $_SESSION['id'];
$current_page = $_SERVER["PHP_SELF"].'?id='.$idc_id;


	$query="SELECT * FROM tbl_idc WHERE id = '$idc_id'";
	$results = mysql_query($query) or die(mysql_error());

	
	while($row = mysql_fetch_assoc($results)):
		$contractor = $row['contractor'];
		$year = $row['year'];
	    $quarter = $row['quarter'];
	    $idc_type = $row['idc_type'];
	    $scope = $row['scope_of_work'];
	    $award = $row['award_amount'];
	    $sum = $row['sum_all_dos'];
	    $contract = $row['contract_balance'];
	    $current = $award - get_do_totals($idc_id);
	    $total_reimbursed = get_do_totals($idc_id) + get_do_reimbursements($idc_id);
	    $commencement = $row['commencement'];
   		$expiration = $row['expiration'];

	endwhile; 
	
$title = "Agency Users";
$subtitle = "IDC Reporting";

// Probably will not needed.
//$docfunc = "/home/httpd/html/PS/ps-docmanV2-func.php";
//include($docfunc);

$header = "/home/httpd/html/PS/ps-header.php";
$footer = "/home/httpd/html/PS/ps-footer.php";
$links = "/home/httpd/html/PS/ps-links.php";


?>
<link rel="stylesheet" type="text/css" media="all" href="js/datechooser/datechooser.css">
<script type="text/javascript" src="js/datechooser/datechooser.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>

<DIV id="contentwrap">
	<DIV id="sidebar">
	
	</DIV>	
<DIV id="ps-content">
	
	
<DIV style="margin-bottom: 15px; margin-top: 2px;"><h3>IDC's for the <?=$name;?> (<a href="logout.php">Log Out</a>)</h3></div>
	<DIV class="info_block">

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
		<td>Sum of all delivery orders issued through end of previous quarter:</td>
		<td><?=$sum?></td>
	<tr>
		<td>Contract balance (end of previous quarter)</td>
		<td><?=$contract;?></td>
	</tr>
	<tr>
		<td>Contract balance (as of <?=date('Y-m-d');?>)</td>
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
</div>
</DIV>

<br />