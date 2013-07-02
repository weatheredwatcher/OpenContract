<?
$title = "Agency Users";
$subtitle = "IDC Reporting";

//ini_set('display_errors','On'); 

$header = "../ps-idc-header.php";
$footer = "../ps-idc-footer.php";
$links = "/home/httpd/html/PS/ps-links.php";

require($header);
require("../config.php");
require("../includes/globalinc.php");
$query = "SELECT * FROM tbl_agency";
$result = mysql_query($query);


?>
<DIV id="contentwrap">
	<DIV id="sidebar">
	
	</DIV>
	<DIV id="ps-content">

		<DIV class="sansbold18" style="margin-bottom: 15px; margin-top: 2px;">&nbsp;<?= $title?></DIV>
		
		<DIV class="info_block">
		<form>
		<select name="agency" id="agencies">
			<option value="0">Select An Agency</option>
			<?php while($row = mysql_fetch_assoc($result)): ?>
  
  				<option value="<?=$row['id'];?>"><?=$row['name'];?></option>
  			<?php endwhile; ?>
</select> <br /> <br />
Engineering:<input type="checkbox" name="engineer" id="idc_engineer" value="engineer" /><br />
Construction<input type="checkbox" name="contruction" id="idc_contruction" value="contruction" /><br />
<br />
<br /><br />
<a href="javascript:document.location=theURL">Download</a> all IDC's under this Agency. <br /><br />
		<select name="dos" id="dos" size="5">
		<option value="all">Select Agency to see all IDC's</option>
  			
</select> <br /> <br /> <br />
<select name="daterange" id ="daterange">
	<option value = "0">All Dates</option>
	<option value = "3">January - March </option>
	<option value = "4">April - June </option>
	<option value = "1">July - Sept </option>
	<option value = "2">October - December </option>
</select><br /> <br />
<input type="submit" name="submit" id="submit" value="Submit" />
</form>
<br />

<?php if(isset($_GET['submit'])): ?>

<? $agency = $_GET['agency']; ?>
<? $idc_id = $_GET['dos']; ?>
<? $daterange = $_GET['daterange']; ?>
<?
GLOBAL $firstQuarterStarts;
GLOBAL $firstQuarterEnds;
GLOBAL $secondQuarterStarts;
GLOBAL $secondQuarterEnds;
GLOBAL $thirdQuarterStarts;
GLOBAL $thirdQuarterEnds;
GLOBAL $fourthQuarterStarts;
GLOBAL $fourthQuarterEnds;


if ($daterange == 0){ $datestamp = ""; }
if ($daterange == 1){ $datestamp = "AND timestamp between '$firstQuarterStarts' and '$firstQuarterEnds'"; }
if ($daterange == 2){ $datestamp = "AND timestamp between '$secondQuarterStarts' and '$secondQuarterEnds'"; }
if ($daterange == 3){ $datestamp = "AND timestamp between '$thirdQuarterStarts' and '$fthirdQuarterEnds'"; }
if ($daterange == 4){ $datestamp = "AND timestamp between '$fourthQuarterStarts' and '$fourthQuarterEnds'"; }
?>


<? $query2 = "SELECT * from tbl_idc WHERE idc_id_internal = '$idc_id' AND agency = '$agency'";
$results2 = mysql_query($query2) or die(mysql_error()); ?>

<? while($row2 = mysql_fetch_assoc($results2)):
		$idc_id = $row2['id'];
		$contractor = $row2['contractor'];
		$year = $row['year'];
	    $quarter = $row2['quarter'];
	    $idc_type = $row2['idc_type'];
	    $scope = $row2['scope_of_work'];
	    $award = $row2['award_Amount'];
	    $sum = $row2['sum_all_dos'];
	    $contract = $row2['contract_balance'];
	    $totals = get_do_totals($idc_id);
	    $current = $award - $totals;
	    $total_reimbursed = get_do_reimbursements($idc_id);
	    $commencement = $row2['commencement'];
   		$expiration = $row2['expiration']; ?>

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
		<td>
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
<? $query2="SELECT * FROM tbl_dos WHERE idc_id = '$idc_id' $datestamp ORDER BY do_id, order_date";
	
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

<?php endif;?>
		</DIV> <!-- info_block-->
	<div id="idc_section">

	</div>

	</DIV> <!-- ps -content -->
</DIV> <!-- contentwrap -->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.3/jquery-ui.min.js"></script>

<script type="text/javascript">
$('#idc_engineer').prop("checked", true);
$('#idc_contruction').prop("checked", true);
var theURL = "write_report_to_array.php?id=agency_var";
$('#agencies').change(function() {
			var idc_eng = $('#idc_engineer').prop("checked");
			var idc_cont = $('#idc_contruction').prop("checked");
			var idc_type = "both";
			
				if (!idc_eng) { idc_type = "construction";}
				if (!idc_cont) { idc_type = "engineer";}
			
			serialized = $('#agencies').serialize() +"&idc_type=" + idc_type;
			theURL = "write_report_to_array.php?id=" + $('#agencies').val();
			console.log(serialized);

			$.ajax({
	  					type: "POST",
	  					url: 'do_by_idc.php',
	  					dataType: 'text',
	  					data: serialized,
	  					success: function(data) { 
	  						document.getElementById("dos").options.length = 0;
	  						var idc_ids = data.split(",");
	  						var select = document.getElementById("dos");
							for(index in idc_ids) {
						    select.options[select.options.length] = new Option(idc_ids[index], idc_ids[index]);
							}
	  						
	  					 }

					});

		});
$('#idc_engineer').change(function() {
			var idc_eng = $('#idc_engineer').prop("checked");
			var idc_cont = $('#idc_contruction').prop("checked");
			var idc_type = "both";
			
				if (!idc_eng) { idc_type = "construction";}
				if (!idc_cont) { idc_type = "engineer";}
			
			serialized = $('#agencies').serialize() +"&idc_type=" + idc_type;
			console.log($('#agencies').val());
			console.log(serialized);

			$.ajax({
	  					type: "POST",
	  					url: 'do_by_idc.php',
	  					dataType: 'text',
	  					data: serialized,
	  					success: function(data) { 
	  						document.getElementById("dos").options.length = 0;
	  						var idc_ids = data.split(",");
	  						var select = document.getElementById("dos");
							for(index in idc_ids) {
						    select.options[select.options.length] = new Option(idc_ids[index], idc_ids[index]);
							}
	  						
	  					 }

					});

		});

$('#idc_contruction').change(function() {
			var idc_eng = $('#idc_engineer').prop("checked");
			var idc_cont = $('#idc_contruction').prop("checked");
			var idc_type = "both";
			
				if (!idc_eng) { idc_type = "construction";}
				if (!idc_cont) { idc_type = "engineer";}
			
			serialized = $('#agencies').serialize() +"&idc_type=" + idc_type;
			console.log($('#agencies').val());
			console.log(serialized);

			$.ajax({
	  					type: "POST",
	  					url: 'do_by_idc.php',
	  					dataType: 'text',
	  					data: serialized,
	  					success: function(data) { 
	  						document.getElementById("dos").options.length = 0;
	  						var idc_ids = data.split(",");
	  						var select = document.getElementById("dos");
							for(index in idc_ids) {
						    select.options[select.options.length] = new Option(idc_ids[index], idc_ids[index]);
							}
	  						
	  					 }

					});

		});


</script>
<?
require($footer);
?>