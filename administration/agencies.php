<?php

require('../config.php');
$title = "Agency Users";
$subtitle = "IDC Reporting";


$header = "/home/httpd/html/PS/ps-header.php";
$footer = "/home/httpd/html/PS/ps-footer.php";

$query="SELECT * from tbl_auditor WHERE inActive = '0'";
$results = mysql_query($query)or die(mysql_error());


require($header);
?>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<DIV id="contentwrap">
	<DIV id="sidebar">
	
	</DIV>	
<DIV id="ps-content">
	<br />
	<a href="add_agent.php" class="btn">Add Agent</a>
	<br />
	<br />
<?php
$results = mysql_query("SELECT tbl_agency.name, tbl_auth.id, tbl_auth.password  FROM tbl_agency, tbl_auth WHERE tbl_agency.id = tbl_auth.id");
echo('<table border="1">');
echo('<tr><th>ID</th><th>Agency Name</th><th>Password</th></tr>');
while ($row = mysql_fetch_assoc($results)) {
echo('<tr>');

	echo('<td>'.$row['id'].'</td>');
	echo('<td>'.$row['name'].'</td>');
	echo('<td>'.$row['password'].'</td>');;
echo('</tr>');	
}?>
</table>
</div>
</div>
<? require($footer);?>
