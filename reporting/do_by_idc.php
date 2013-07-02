<?php
require("../config.php");
$idc_id = $_POST['agency'];
$idc_type = $_POST['idc_type'];




if ($idc_type == "both"):
$query = "SELECT idc_id_internal FROM tbl_idc WHERE agency = '$idc_id'";
else:
$query = "SELECT idc_id_internal FROM tbl_idc WHERE agency = '$idc_id' AND idc_type = '$idc_type'";
endif;

$result = mysql_query($query)or die(mysql_errno());

while($row=mysql_fetch_assoc($result)):

	echo $row['idc_id_internal']. ",";

endwhile;

//end