<?php
$title = "Administration";
$subtitle = "User Management and IDC Reporting";

// Probably will not needed.
//$docfunc = "/home/httpd/html/PS/ps-docmanV2-func.php";
//include($docfunc);

$header = "/home/httpd/html/PS/ps-header.php";
$footer = "/home/httpd/html/PS/ps-footer.php";
$links = "/home/httpd/html/PS/ps-links.php";

require($header);
?>
<DIV id="contentwrap">
	<DIV id="sidebar">
	<?include ($links)?>
	</DIV>
	<DIV id="ps-content">
		<DIV class="sansbold18" style="margin-bottom: 15px; margin-top: 2px;">&nbsp;<?= $title?></DIV>
		<DIV class="info_block">
		
		<ul>
			<li><a href="../testing/view_log.php">View Log</a></li>
			<li><a href="../testing/gen_report.php">Generate Reports</a></li>
			<li><a href="agencies.php">Manage Agencies</a></li>
			<li><a href="auditors.php">Auditors</a></li>
		</ul>
		</DIV> <!-- info_block-->
	</DIV> <!-- ps -content -->
</DIV> <!-- contentwrap -->
<?
require($footer);
?>