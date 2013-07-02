<?php
/**
*
*  log viewer
*
*
*
*/
//ini_set('display_errors','On'); 
require('includes/db-include.php');
require('includes/globalinc.php');
$header = "/home/httpd/html/PS/ps-header.php";
$footer = "/home/httpd/html/PS/ps-footer.php";
$links = "/home/httpd/html/PS/ps-links.php";
require('includes/db-include.php');
require($header);
$log_type = $_GET['log_type'];

//this is where we filter the log view.
switch ($log_type) {
	case 'login':
		$query = ("SELECT * FROM log WHERE activity='login' ORDER BY id desc ");
		break;

	case 'logout':
		$query = ("SELECT * FROM log WHERE activity='logout' ORDER BY id desc ");
		break;

	case 'failed':
		$query = ("SELECT * FROM log WHERE activity='failed login' ORDER BY id desc ");
		break;

	case 'idc':
		$query = ("SELECT * FROM log WHERE activity='idc' ORDER BY id desc ");
		break;

	case 'do':
		$query = ("SELECT * FROM log WHERE activity='do' ORDER BY id desc ");
		break;
	
	default:
		$query = ("SELECT * FROM log ORDER BY id desc ");
		break;
}

$results = mysql_query($query) or die(mysql_error());

?>
<DIV id="contentwrap">
	<DIV id="sidebar">
	
	</DIV>
	<DIV id="ps-content">
		<DIV class="sansbold18" style="margin-bottom: 15px; margin-top: 2px;">&nbsp;<?= $title?></DIV>
		<DIV class="info_block">
			Filter:&nbsp;<a href="view_log.php?log_type=all">All</a> &nbsp; &nbsp; 
			<a href="view_log.php?log_type=login">Login</a> &nbsp; &nbsp; 
			<a href="view_log.php?log_type=logout">Logout</a> &nbsp; &nbsp;
			<a href="view_log.php?log_type=failed">Failed</a> &nbsp; &nbsp; 
			<a href="view_log.php?log_type=idc">IDCs</a> &nbsp; &nbsp; 
			<a href="view_log.php?log_type=do">DO's</a> 
<table border=1>
	<tr>
		<th>Activity</th>
		<th>IP Address</th>
		<th>Extra Information</th>
		<th>Timestamp</th>
		<th>Action</th>
	</tr>
	<? while($row = mysql_fetch_assoc($results)): ?>
	<tr>
		<td><?=$row['activity'];?></td>
		<td><?=$row['ip_address'];?></td>
		<td><?=$row['extra'];?></td>
		<td><?=$row['timestamp'];?></td>
		<td><a href="#">BLOCK</a></td>
	<tr>
	<? endwhile; ?>
</table>
</DIV> <!-- info_block-->
	</DIV> <!-- ps -content -->
</DIV> <!-- contentwrap -->
<?
require($footer);
?>