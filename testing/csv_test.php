<?php
require_once ("../config.php");
ini_set('display_errors','On'); 

if(isset($_POST['submit'])){

	$target_path = "../downloads/";

$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
    " has been uploaded";
} else{
    echo "There was an error uploading the file, please try again!";
    die();
}


$source_file = "../downloads/".basename( $_FILES['uploadedfile']['name']);
$target_table = "tbl_idc";
$handle = fopen("$source_file", "r");
$row = 1;
while (($data = fgetcsv($handle, 100000, ",")) !== FALSE):

        $commencement = $data[5];
        $expiration = $data[6];
        $commencement = date('Y-m-d', strtotime(str_replace('-', '/', $commencement)));
        $expiration = date('Y-m-d', strtotime(str_replace('-', '/', $expiration)));
$import="INSERT into tbl_idc(idc_id_internal, agency, contractor, idc_type, scope_of_work, award_amount, commencement, expiration) values('$data[0]', 'e24', '$data[1]','$data[2]','$data[3]', '$data[4]', '$commencement', '$expiration')";
if ($data[1] != "contractor"):
mysql_query($import) or die(mysql_error());
endif;
endwhile;
fclose($handle);
print "Import done";}

else{
echo ('
<form enctype="multipart/form-data" action="csv_test.php" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
Choose a file to upload: <input name="uploadedfile" type="file" /><br />
<input type="submit" name="submit" id="submit" value="Upload File" />
</form>

');
}
//end of csv_test.php