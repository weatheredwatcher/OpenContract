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

require('../config.php');
require('../includes/globalinc.php');


$name = $_SESSION['name'];
$id = $_SESSION['id'];

$results = mysql_query("SELECT * FROM tbl_idc WHERE active = '1'");

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
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<style>

td {

	padding: 10px;
}
</style>
	<body>

	<DIV id="contentwrap">
	<DIV id="sidebar">
	
	</DIV>	
<DIV id="ps-content" style="width: 860px;">
	
	
<DIV class="sansbold18" style="margin-bottom: 15px; margin-top: 2px;"><h3> Welcome! <?=$name;?> (<a href="../logout.php">Log Out</a>)</h3></div>
	<DIV class="info_block" style="width: 845px;">
	<table border="1">
		<tr>
			<th>IDC ID</th><th>Scope</th>
		</tr>
		<?php while($row = mysql_fetch_assoc($results)): ?>

			<tr>
				<td><a href="details_idc.php?id=<?=$row['id'];?>"><?=$row['idc_id_internal'];?></a></td>
				
				<td><?=$row['scope_of_work'];?></td>
				
		
	<?php endwhile; ?>
	</table>
	<br />
	
</div>
</div>
</DIV>
	<? require($footer);?>
	</body>
</html>