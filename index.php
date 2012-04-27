<?php
/**
*
*   Index page for the bew IDC project 
*   @author David Duggins
*   @version 0.1a
*   @package IDC
*/

$title = "Agency Users";
$subtitle = "IDC Reporting";

// Probably will not needed.
//$docfunc = "/home/httpd/html/PS/ps-docmanV2-func.php";
//include($docfunc);

$header = "/home/httpd/html/PS/ps-header.php";
$footer = "/home/httpd/html/PS/ps-footer.php";
$links = "/home/httpd/html/PS/ps-links.php";

require($header);
require('includes/db-include.php');
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

		<div id="three_column" style="margin-top: 5px">

			<DIV id="col_1">
			<IMG src="/images/ag_user.jpg" width="240" height="60" alt="Agency Users" border=0>
				<DIV class="col_header"><h2>Agency Users</h2></DIV>
				<DIV class="col_body">
				<UL>
					<LI><A title="Login to Reporting" href="reporting/">Login to Reporting</A>
					
					
				</UL>
				</DIV>
			</DIV>
			
			<DIV id="col_2">
			<IMG src="/images/vend_constr.jpg" width="240" height="60" alt="Vendors/Contractors" border=0>
				<DIV class="col_header"><h2>Vendors/Contractors</h2></DIV>
				<DIV class="col_body">
				<UL>
					<LI><A title="Login to IDC System" href="system/">Login to IDC System</A>
				</UL>
			</DIV>
			</DIV>
			
			<DIV id="col_3">
			<IMG src="/images/pol_subdiv.jpg" width="240" height="60" alt="Political Subdivisions" border=0>
				<DIV class="col_header"><h2>Public Access</h2></DIV>
				<DIV class="col_body">
				<UL>
					<LI><A title="Resources for Political Subdivisions" href="/PS/pol_sub/PS-polsub-resources.phtm">Search IDC Data</A>
					<LI><A title="Resources for Political Subdivisions" href="/PS/pol_sub/PS-polsub-resources.phtm">Browse IDC Data by Agency</A>
				</UL>				
				</DIV>	

		</div> <!-- three_column end -->
		</DIV> <!-- info_block-->
	</DIV> <!-- ps -content -->
</DIV> <!-- contentwrap -->
<?
require($footer);


?>