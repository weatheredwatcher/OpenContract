<?php

require('../config.php');
$title = "Agency Users";
$subtitle = "IDC Reporting";


$header = "/home/httpd/html/PS/ps-header.php";
$footer = "/home/httpd/html/PS/ps-footer.php";

require($header);

if(isset($_GET['submit'])){

  $id = $_GET['id'];
  $name= $_GET['name'];
  $password = $_GET['password'];

 		$agency = ("INSERT INTO tbl_agency (id, name) VALUES ('$id', '$name')");
 		$auth = ("INSERT INTO tbl_auth (id, password) VALUES ('$id', '$password')");
mysql_query($agency);
mysql_query($auth);
}
?>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<DIV id="contentwrap">
	<DIV id="sidebar">
	
	</DIV>	
<DIV id="ps-content">
	<br />
	<br />
	<br />
<form>
<table border="1">

<tr>
	<td>Agency ID </td>
	<td><input type="text" name="id" />
</tr>
<tr>
	<td>Agency Name</td>
	<td><input type="text" name="name" />
</tr>
<tr>
<td>Password</td>
<td><input type="text" id="password" name="password" /></td>
</tr>

</table>
<a href="#" class="btn" onClick="genPassword();">Generate Password</a><input type="submit"  class="btn" name="submit" value="Add" />
</form>
</div>
</div>
<? require($footer);?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script type="text/javascript">

function genPassword(){

$.ajax({
	  					url: '../includes/gen_password.php',
	  					success: function(data) { 

	  						$('#password').val(data);
	  						
	  					 }

					});

}
</script>