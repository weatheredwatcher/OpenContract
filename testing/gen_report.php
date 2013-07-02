<?php
/**
*
*  This is a general report builder for the IDC system
*
*
*
*/

/**
*$select = "SELECT tbl_idc.*, tbl_dos.do_id, tbl_dos.pro_name, tbl_dos.basic";
*$from = "FROM tbl_idc, tbl_dos";
*$where = "WHERE tbl_idc.contractor="John Doe" AND tbl_dos.basic >10000";
*/

require('includes/db-include.php');
require('includes/globalinc.php');
ini_set('display_errors','On'); 
$header = "/home/httpd/html/PS/ps-header.php";
$footer = "/home/httpd/html/PS/ps-footer.php";
$links = "/home/httpd/html/PS/ps-links.php";



$builder = array(
	"tbl_idc" => array("id", "agency", "contractor", "year", "quarter", "idc_type", "scope_of_work", "award_amount", "sum_all_dos", "contract_balance", "current_balance", "commencement", "expiration"),
	"tbl_dos" => array("idc_id", "order_date", "do_id", "pro_name", "basic", "additional", "reimbursed"),
	"tbl_agency" => array("id", "name")
);

require('includes/db-include.php');
require($header);
?>

<DIV id="contentwrap">
	<DIV id="sidebar">
	
	</DIV>
	<DIV id="ps-content" style="width: 900px">
		<DIV class="sansbold18" style="margin-bottom: 15px; margin-top: 2px;">&nbsp;<?= $title?></DIV>
		<p> This generator will build basic queries, including simple joins. It's primary use is to allow for quick reports on the fly and also
			for facilitating the building of static reports.</p>
			<form method="post" action="reports_process.php">
			<h1>SELECT</h1>	
			<? foreach ($builder as $table => $fields): ?>
				<fieldset>
				<legend><?=$table;?>:</legend>
				<? foreach ($fields as $types): ?>
				<input type="checkbox" id="<?=$table;?>_<?=$types;?>" name="<?=$table;?>"  /><?=$types;?> 
			<? endforeach; ?> 
		</fieldset>
			<? endforeach; ?>
			<h1>FROM</h1>
<? foreach ($builder as $table => $fields): ?>
				<input type="checkbox" name="<?=$table;?>" /><?=$table;?>
				
			<? endforeach; ?>

			<h1>WHERE</h1>
			<? foreach ($builder as $table => $fields): ?>
				<fieldset>
				<legend><?=$table;?>:</legend>
				
				<? foreach ($fields as $types): ?>
				<?=$types;?> <input type="text" name="<?=$types;?>" /><br /> 
			<? endforeach; ?> 
		</fieldset>
			<? endforeach; ?>

<input type="submit" name="submit" />
</form>

	</DIV> <!-- ps -content -->
</DIV> <!-- contentwrap -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">


$('input[name=tbl_idc]').click(function() {
			alert (this.id + " was clicked!");
		});
</script>
<?
require($footer);
?>