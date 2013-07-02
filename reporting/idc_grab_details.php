<?php
require("../config.php");
$idc_id = $_POST['dos'];

$query = "SELECT * FROM tbl_idc WHERE idc_id_internal = '$idc_id'";
$result = mysql_query($query)or die(mysql_errno());

//end