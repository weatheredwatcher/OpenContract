<?php>

require_once('../config.php');
require('../includes/globalinc.php');


$title = "Auditor Users";
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

<h1>Edit Auditors List </h1>	
<p> Edit/Delete and Add Auditors to the list</p>
<table>
	<tr>
		<th>Email</th>
		<th>Name</th>
		
		<th>Action</th>
	</tr>
	<?php while($row = mysql_fetch_assoc($results)): ?>
	<tr>
		<td><?=$row['email'];?></td>
		<td><?=$row['name'];?></td>
		<td><a href="edit-auditors.php?id=<?=$row['id'];?>" class="btn">Edit</a>  <a href="del_auditor.php?id=<?=$row['id'];?>" class="btn btn-danger">Deactivate</a></td>
	</tr>
<? endwhile; ?>
</table>
<a href="add-auditor.php" class="btn btn-large"><i class="icon-plus-sign"></i> Add</a>
</DIV>
</DIV>


<?
require($footer);
?>

