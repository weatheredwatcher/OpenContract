<?php
$title = "TESTING";
$subtitle = "IDC Reporting";

// Probably will not needed.
//$docfunc = "/home/httpd/html/PS/ps-docmanV2-func.php";
//include($docfunc);

$header = "/home/httpd/html/PS/ps-header.php";
$footer = "/home/httpd/html/PS/ps-footer.php";
$links = "/home/httpd/html/PS/ps-links.php";
require('includes/db-include.php');
require($header);
$results = mysql_query("SELECT tbl_agency.name, tbl_auth.id, tbl_auth.password  FROM tbl_agency, tbl_auth WHERE tbl_agency.id = tbl_auth.id");
?>
<DIV id="contentwrap">
	<DIV id="sidebar">
	
	</DIV>
	<DIV id="ps-content">
		<DIV class="sansbold18" style="margin-bottom: 15px; margin-top: 2px;">&nbsp;<?= $title?></DIV>
		<DIV class="info_block">
		<table border="1">
			<tr><th>ID</th><th>Agency Name</th><th>Password</th></tr>
		<? while ($row = mysql_fetch_assoc($results)): ?>
			<tr>
				<td><?=$row['id'];?></td>
				<td><?=$row['name'];?></td>
				<td><?=$row['password'];?></td>
			</tr>
		<? endwhile; ?>
	</table>

		</DIV> <!-- info_block-->
	</DIV> <!-- ps -content -->
</DIV> <!-- contentwrap -->
<?
require($footer);
?>