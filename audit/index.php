<?php
 
  /**
   *
   * This is the index.  It includes the Login procedures
   *
   */

//session block
session_start();

//todo:add blacklist feature to block certain ip address
ini_set('display_errors','On'); 
require('../includes/db-include.php');
require('../includes/globalinc.php');

if (isset($_SESSION['auth'])){

	load_index();
}else {

if(isset($_POST['submit'])){

auth();

}

else {

	show_login('Please log in to Continue');
}
}

function load_index(){

	header("Location: http://procurement.sc.gov/PS/agency/IDC/audit/main.php");
}

function auth(){
$id= mysql_escape_string($_POST['login']);
$password = mysql_escape_string($_POST['password']);

$query= mysql_query("SELECT * FROM tbl_auditor WHERE email = '$id' and password ='$password' and inActive = 0 limit 1");

	if(mysql_num_rows($query) == 1) {

		$_SESSION['auth'] = "1";
		$_SESSION['id'] = $id;
		$_SESSION['name'] = get_auditor_name($id);  
		$_SESSION['ses_start'] = date('Y-m-d-h-i-s');
		$_SESSION['log_ip'] = $_SERVER['REMOTE_ADDR'];
		log_activity('login');
		load_index();

		
	}
	else{

		$error_message = 'Sorry, try again! (your ip address has been recorded)';
		// This is an example of a generic log entry
		$_SESSION['extra'] = $id; //we set the extra var to the attemped user id
		$_SESSION['log_ip'] = $_SERVER['REMOTE_ADDR'];  //we record the ip address
		log_activity('failed login');  //we use a string to id the activity and write the log
		//  end of logging

		show_login($error_message);

	}
//echo $query;
}



function show_login($message){

$title = "Agency Users";
$subtitle = "IDC Reporting";

// Probably will not needed.
//$docfunc = "/home/httpd/html/PS/ps-docmanV2-func.php";
//include($docfunc);

$header = "/home/httpd/html/PS/ps-header.php";
$footer = "/home/httpd/html/PS/ps-footer.php";
$links = "/home/httpd/html/PS/ps-links.php";

require($header);


?>
<body onload="document.auth.login.focus();">

<?php

echo('<DIV id="contentwrap">
	<DIV id="sidebar">');
	include ($links);
	echo('</DIV>
	<DIV id="ps-content">

		<DIV class="sansbold18" style="margin-bottom: 15px; margin-top: 2px;">&nbsp;<?= $title?></DIV>
		<DIV class="info_block">');
        echo('<h1>'.$message.'</h1>');
		echo('<form name="auth" id="auth" method="post" action="index.php">

<table border=1 style="margin: 75px;">
	
	<tr>
		<td colspan="2" align="center">Auditor Login</td>
	</tr>
	<tr>
		<td>Login:</td>
		<td><input type="text" name="login" id="login" /></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type="password" name="password" /></td>
	</tr>
        <tr>
                <td colspan="2" align="right"><input type="submit" name="submit" value="Login"  /></td>
        </tr>
</table>
</form>
<a href="../index.php">Agency Login </a>		
		</DIV> <!-- info_block-->
	</DIV> <!-- ps -content -->
</DIV> <!-- contentwrap -->');
require($footer);


}

?>