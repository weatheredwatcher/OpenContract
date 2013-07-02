<?php>
ini_set('display_errors','On'); 
require_once('../config.php');
require('../includes/globalinc.php');

$name = $_GET['name'];
$email = $_GET['email'];
$password = $_GET['password'];



$title = "Agency Users";
$subtitle = "IDC Reporting";


$header = "/home/httpd/html/PS/ps-header.php";
$footer = "/home/httpd/html/PS/ps-footer.php";

$query="SELECT * from tbl_auditor WHERE id='$id'";
$results = mysql_query($query)or die(mysql_error());


require($header);
if(isset($_GET['Submit'])){

$query2 = "INSERT INTO tbl_auditor (email, name, password) VALUES('$email' , '$name','$password')"; 
		
	   mysql_query($query2) or die(mysql_error());
	   header("Location: auditors.php");

} else {



?>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<DIV id="contentwrap">
	<DIV id="sidebar">
	
	</DIV>	
<DIV id="ps-content">
	

<form method="put" action="add-auditor.php">
	
	Email<input type="text" name="email" id="email" /><br />
	Name<input type="text" name="name" id="name" /><br />
	Password<input type="password" name="password" id="password" />


<input type="submit" name="Submit" id="submit" value="Submit" />
</form>
</DIV>
</DIV>






<?
}
require($footer);
?>

