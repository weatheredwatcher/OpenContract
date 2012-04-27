<?
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<?
$title = "Procurement Services<BR>Audit &amp; Certification<BR>Agency Quarterly Updates";

extract($_SERVER);
//extract($_GET); // disable this when in production!!!!!
//extract($_POST);

$debug = FALSE;
//$debug = TRUE;

$dbhost = "localhost";
$dbuser = "root";
$dbpword = "";
$dbname = "SFM_assignments";
$dbtable = "Vehicles";

if(!mysql_connect($dbhost, $dbuser))
{
	echo "Database not available! Contact the IS staff.<BR>";
	echo mysql_error();
	exit();
}

mysql_select_db($dbname);

?>
<HTML>  
<HEAD>  
	<TITLE><? echo $title?></TITLE>  
	<META NAME="Author" CONTENT="Doug Smoak - DSmoak@bcbis.sc.gov">  
	<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<LINK rel="stylesheet" href="/statefleet/imaging/sfm-img-styles.css" type="text/css" title="Basic Styles">
	<LINK rel="stylesheet" href="/button-styles.css" type="text/css">
	<LINK rel="stylesheet" href="/pixel.css" type="text/css">
	<LINK rel="StyleSheet" href="/block-styles.css" type="text/css">
	<LINK rel="shortcut icon" href="/statefleet3.ico" type="image/x-icon">
		<SCRIPT> 
			<!-- 

			function trim(str) {
			 // skip leading and trailing whitespace
			 // and return everything in between
			  var x=str;
			  x=x.replace(/^\s*(.*)/, "$1");
			  x=x.replace(/(.*?)\s*$/, "$1");
			  return x;
			}

			// --> 
	</SCRIPT>

	<STYLE>
	#headline2
	{
		color: #333366;
		font-size:18px;
		font-family:verdana,arial;
		font-weight:bold;
		margin-left:245px;
		margin-top: 5px;
		position:absolute;
	}

	.my-input {
		background-color: #fff;
		padding: 2px;
		-webkit-border-radius: .5em; 
		-moz-border-radius: .5em;
		border-radius: .5em;
		-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.2);
		-moz-box-shadow: 0 1px 2px rgba(0,0,0,.2);
		box-shadow: 0 1px 2px rgba(0,0,0,.2);
	}
	
	#pageheader2
	{
		height: 85px;
		padding: 0;
		margin: 0;
		background: url(/images/bcb/background-grad5.jpg) #fff; 
	}

	.gray-box
		{
			border: 1px solid rgb(98, 105, 199); 
			background-color: #eceef6;
		}
	</STYLE>
</HEAD>  
<!-- ********************************************************************* -->  
<!-- **		         Copyright (c) <?echo date("y");?>		        ** -->  
<!-- **            South Carolina State Budget and Control Board        ** -->  
<!-- **		       Information Services		      ** -->  
<!-- **		       All Rights Reserved		       ** -->  
<!-- ********************************************************************* --> 
<BODY>
<DIV id="block-bar"></DIV>
<DIV id="pageheader2">
<DIV id="headline2"><?echo $title?></DIV>
<TABLE width="95%" border=0 cellspacing=0 cellpadding=0>
<TR valign="top"><TD nowrap style="font-size:20px" height=30>
<A href="/PS/"><IMG src="/images/BCB-logo-2009.jpg" width="163" height="80" title="Click for Procuerment Services Home Page" border="0"></A>
</TD></TR>
</TABLE>
</DIV>
<DIV id="block-bar"></DIV>
<P>