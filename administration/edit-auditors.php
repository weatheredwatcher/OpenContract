<?php>
//require_once('../config.php');
require('../includes/globalinc.php');

$name = $_GET['name'];
$email = $_GET['email'];
$password = $_GET['password'];
$id = $_GET['id'];


$title = "Agency Users";
$subtitle = "IDC Reporting";


$header = "/home/httpd/html/PS/ps-header.php";
$footer = "/home/httpd/html/PS/ps-footer.php";

$query="SELECT * from tbl_auditor WHERE id='$id'";
$results = mysql_query($query)or die(mysql_error());


require($header);
if(isset($_GET['Submit'])){

$query2 = "UPDATE tbl_auditor set email='$email' , name='$name', password='$password' WHERE id='$id'"; 
		
	   mysql_query($query2) or die(mysql_error());
	   header("Location: auditors.php");

} else {



?>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<DIV id="contentwrap">
	<DIV id="sidebar">
	
	</DIV>	
<DIV id="ps-content">
	

<form method="put" action="edit-auditors.php">
	<?php while($row = mysql_fetch_assoc($results)): ?>
	<input type="hidden" name="id" value="<?=$id;?>" />
	Email<input type="text" name="email" id="email" value="<?=$row['email'];?>" /><br />
	Name<input type="text" name="name" id="name" value="<?=$row['name'];?>" /><br />
	Password<input type="password" name="password" id="password" value="<?=$row['password'];?>" />

<? endwhile; ?>
<input type="submit" name="Submit" id="submit" value="Submit" />
</form>
</DIV>
</DIV>






<?
}
require($footer);
?>

