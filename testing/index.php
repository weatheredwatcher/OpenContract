<?php
$title = "TESTING";
$subtitle = "IDC Reporting";

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
		The <SPAN style="font-weight:bold">Office of State Engineer</SPAN> (OSE) is responsible for (some wording to
		be determined by John White, etc.).

		<ul>
			<li><a href="agency_test.php">Agency Login List</a></li>
			<li><a href="view_log.php">View Log</a></li>
			<li><a href="gen_report.php">Generate Reports</a></li>
		</DIV> <!-- info_block-->
	</DIV> <!-- ps -content -->
</DIV> <!-- contentwrap -->
<?
require($footer);
?>