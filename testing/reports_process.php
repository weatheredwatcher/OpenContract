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

//gather the post data:

#Select
$select = "SELECT ";
//tbl_idc

if(isset($_POST['tbl_idc_id'])) { $select .= 'tbl_idc.id '; }
if(isset($_POST['tbl_idc_agency'])) { $select .= 'tbl_idc.agency '; }
if(isset($_POST['tbl_idc_contractor'])) { $select .= 'tbl_idc.contractor '; }
if(isset($_POST['tbl_idc_year'])) { $select .= 'tbl_idc.year '; }
if(isset($_POST['tbl_idc_id'])) { $select .= 'tbl_idc.quarter '; }


#From
$from = "FROM ";
if(isset($_POST['tbl_idc'])) { $from .= 'tbl_idc '; }
if(isset($_POST['tbl_dos'])) { $from .= 'tbl_dos '; }
if(isset($_POST['tbl_agency'])) { $from .= 'tbl_agency '; }

#WHERE
$where = "WHERE ";

if ($_POST['additional'] == "") {} else {$where .= "additional ". addslashes($_POST['additional']);	}
/**$_POST['agency'];
$_POST['award_amount'];
$_POST['basic'];	
$_POST['commencement'];
$_POST['contract_balance'];
$_POST['contractor'];
$_POST['current_balance'];
$_POST['do_id'];
$_POST['expiration'];
$_POST['idc_id'];
$_POST['idc_type'];	
$_POST['name'];
$_POST['order_date	'];
$_POST['pro_name'];
$_POST['quarter'];
$_POST['reimbursed'];
$_POST['scope_of_work'];
$_POST['sum_all_dos'];
$_POST['year'];
*/
#QUERY
$query = $select.$from.$where;
echo $query;
//$query = trim($query);
//mysql_query(trim($query))or die(mysql_error());



require('includes/db-include.php');
require($header);
?>

<DIV id="contentwrap">
	<DIV id="sidebar">
	
	</DIV>
	<DIV id="ps-content" style="width: 900px">
		<DIV class="sansbold18" style="margin-bottom: 15px; margin-top: 2px;">&nbsp;<?= $title?></DIV>
		

	</DIV> <!-- ps -content -->
</DIV> <!-- contentwrap -->
<?
require($footer);
?>