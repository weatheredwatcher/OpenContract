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

require('includes/db-include.php');
require('includes/globalinc.php');


$name = $_SESSION['name'];
$id = $_SESSION['id'];

$results = mysql_query("SELECT * FROM tbl_idc WHERE agency = '$id' AND active = '1'");

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
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<style>

td {

	padding: 10px;
}
</style>
	<body>

	<DIV id="contentwrap">
	<DIV id="sidebar">
	
	</DIV>	
<DIV id="ps-content" style="width: 760px;">
	
	
<DIV class="sansbold18" style="margin-bottom: 15px; margin-top: 2px;"><h3> IDC's for the <?=$name;?> (<a href="logout.php">Log Out</a>)</h3></div>
	<DIV class="info_block" style="width: 745px;">
	<table border="1">
		<tr>
			<th>IDC ID</th><th>Year</th><th>Quarter</th><th>Contractor</th><th>Type</th><th>Scope</th><th>Action</th>
		</tr>
		<?php while($row = mysql_fetch_assoc($results)): ?>

			<tr>
				<td><?=$row['idc_id_internal'];?></td>
				<td><?=date('Y');?></td>
				<td><?=current_quarter();?></td>
				<td><?=$row['contractor'];?></td>
				<td><?=$row['idc_type'];?></td>
				<td><?=$row['scope_of_work'];?></td>
				<td> <a class="btn" href="details_idc.php?id=<?=$row['id'];?>"><i class="icon-eye-open"></i> Details</a>&nbsp; &nbsp;<a class="btn btn-danger" href="del_idc.php?idc=<?=$row['id'];?>"><i class="icon-trash icon-white"></i></a></td></tr>
		
	<?php endwhile; ?>
	</table>
	<br />
	<a class="btn" href="add_idc.php"><i class="icon-plus-sign"></i> Add New IDC</a>
	<a class="btn" href="upload_csv.php"><i class="icon-folder-open"></i> Batch Upload IDCs</a>
</div>
</div>
</DIV>
	<? require($footer);?>
	</body>
</html>