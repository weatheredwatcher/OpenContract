<?php
//session block
session_start();
$title = "Agency Users";
$subtitle = "IDC Reporting";

// Probably will not needed.
//$docfunc = "/home/httpd/html/PS/ps-docmanV2-func.php";
//include($docfunc);

$header = "/home/httpd/html/PS/ps-header.php";
$footer = "/home/httpd/html/PS/ps-footer.php";
$links = "/home/httpd/html/PS/ps-links.php";
$id = $_SESSION['id'];

require($header);
require_once ("config.php");


ini_set('display_errors','On'); 
echo('<DIV id="contentwrap">
	<DIV id="sidebar"></div>
<DIV id="ps-content">
		<DIV class="sansbold18" style="margin-bottom: 15px; margin-top: 2px;">&nbsp;<?= $title?></DIV>
		<DIV class="info_block">');
if(isset($_POST['submit'])){

	$target_path = "downloads/";

$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    echo "<ul><li>The file ".  basename( $_FILES['uploadedfile']['name']). 
    " has been uploaded</li>";
} else{
    echo "There was an error uploading the file, please try again!";
    die();
}


$source_file = "downloads/".basename( $_FILES['uploadedfile']['name']);
$target_table = "tbl_idc";
$handle = fopen("$source_file", "r");
$row = 1;
while (($data = fgetcsv($handle, 100000, ",")) !== FALSE):

        $commencement = $data[5];
        $expiration = $data[6];
        $commencement = date('Y-m-d', strtotime(str_replace('-', '/', $commencement)));
        $expiration = date('Y-m-d', strtotime(str_replace('-', '/', $expiration)));
$import="INSERT into tbl_idc (idc_id_internal, agency, contractor, idc_type, scope_of_work, award_amount, commencement, expiration) values('$data[0]', '$id', '$data[1]','$data[2]','$data[3]', '$data[4]', '$commencement', '$expiration')";
if ($data[1] != "contractor"):
mysql_query($import) or die(mysql_error());
endif;
endwhile;
fclose($handle);
print "<li>Import done</li></ul>";}

else{
echo ('
<form enctype="multipart/form-data" action="upload_csv.php" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
Choose a file to upload: <input name="uploadedfile" type="file" /><br />
<input type="submit" name="submit" id="submit" value="Upload File" />
</form>
</div></div>
');
}

require($footer);

//end of csv_test.php