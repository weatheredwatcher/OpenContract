<?php

require('includes/db-include.php');
require('includes/gen_password.php');

$results = mysql_query("SELECT tbl_agency.name, tbl_auth.id, tbl_auth.password  FROM tbl_agency, tbl_auth WHERE tbl_agency.id = tbl_auth.id");
echo('<table border="1">');
echo('<tr><th>ID</th><th>Agency Name</th><th>Password</th></tr>');
while ($row = mysql_fetch_assoc($results)) {
echo('<tr>');

	echo('<td>'.$row['id'].'</td>');
	echo('<td>'.$row['name'].'</td>');
	echo('<td>'.$row['password'].'</td>');;
echo('</tr>');	
}
?>
<form name="add_agency">

	<table>
		<tr>
			<th>Agency Number</th>
			<th>Agency Name</th>
			<th>Password</th>
		</tr>
		<tr>
			<td>