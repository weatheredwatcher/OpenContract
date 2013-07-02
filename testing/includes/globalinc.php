<?php
/**
*
*  Global Includes Files
*
*
*/
require_once('db-include.php');

function get_agency_name($id){

	$query = "SELECT name FROM tbl_agency WHERE id = '$id'";
	$results = mysql_query($query);
	while($row = mysql_fetch_assoc($results)){

		$name = $row['name'];

		return $name;
	}
}

function get_quarter($month){

switch ($month)
    {
    case ($month=='Jan' || $month=='Feb' || $month=='Mar'):
        $quarter = "3";
        break;
    case ($month=='Apr' || $month=='May' || $month=='Jun'):
        $quarter = "4";
        break;
    case ($month=='Jul' || $month=='Aug' || $month=='Sep'):
        $quarter = "1";
        break;
    case ($month=='Oct' || $month=='Nov' || $month=='Dec'):
        $quarter = "2";
        break;
    } 

    return $quarter;

}


?>