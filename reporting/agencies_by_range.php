<?
$title = "Agency Users";
$subtitle = "IDC Reporting";

// Probably will not needed.
//$docfunc = "/home/httpd/html/PS/ps-docmanV2-func.php";
//include($docfunc);

ini_set('display_errors','On'); 

$header = "../ps-idc-header.php";
$footer = "../ps-idc-footer.php";
$links = "/home/httpd/html/PS/ps-links.php";

require($header);
require("../config.php");
$query = "select tbl_agency.name, tbl_idc.id, tbl_idc.idc_id_internal, tbl_idc.contractor, tbl_idc.idc_type, tbl_idc.scope_of_work, tbl_idc.award_Amount, tbl_idc.commencement, tbl_idc.expiration from tbl_idc, tbl_agency WHERE tbl_agency.id = tbl_idc.agency timestamp between '$startDate' and '$endDate'
";
$results = mysql_query($query) or die(mysql_error());


?>
<DIV id="contentwrap">
	<DIV id="sidebar">
	
	</DIV>
	<DIV id="ps-content">

		<DIV class="sansbold18" style="margin-bottom: 15px; margin-top: 2px;">&nbsp;<?= $title?></DIV>
		
		<DIV class="info_block">
		
		<? while ($row = mysql_fetch_assoc($results)): ?>
		<table border="1" width="750">
			<tr>
				<th>Agency Name</th>
				<th>Current IDC's</th>
				<th>Contractor</th>
				<th> Type </th>
				<th>Scope of Work</th>
				<th>Award Amount</th>
				<th>Commencement</th>
				<th>Expiration</th>
			</tr>
		<tr>
			<td><?=$row['name'];?></td>
			<td><?=$row['idc_id_internal'];?></td>
			<td><?=$row['contractor'];?></td>
			<td><?=$row['idc_type'];?></td>
			<td><?=$row['scope_of_work'];?></td>
			<td><?=$row['award_Amount'];?></td>
			<td><?=$row['commencement'];?></td>
			<td><?=$row['expiration'];?></td>
		</tr>
		</table>
		<br />
		<table border="1" width="750">
			<tr>
			<th>Order Date</th>
			<th>DO ID</th>
			<th>Project Name</th>
			<th>Cost/Fees</th>
			<th>Reimbursed</th>
			<th>Amendment</th>
			<th> OSE Verify</th>
		</tr>
		<? 
		$id = $row['id'];
			$doquery = "select * from tbl_dos where idc_id = '$id'" and ;
			$doresults = mysql_query($doquery);
			while($dorow = mysql_fetch_assoc($doresults)):
		?>
		<tr>
			<td><?=$dorow['order_date'];?></td>
			<td><?=$dorow['do_id'];?></td>
			<td><?=$dorow['pro_name'];?></td>
			<td><?=$dorow['basic'];?></td>
			<td><?=$dorow['reimbursed'];?></td>
			<td><?=$dorow['amendment'];?></td>
			<td><?=$dorow['ose_verify'];?></td>

		<? endwhile;?>
	</table>
	<br />
		<? endwhile;?>
	

		</DIV> <!-- info_block-->
	</DIV> <!-- ps -content -->
</DIV> <!-- contentwrap -->
<?
require($footer);
?>