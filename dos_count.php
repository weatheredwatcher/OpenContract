<?php
# test function

require('includes/db-include.php');

function get_do_totals($idc){
	
	$query2="SELECT * FROM tbl_dos WHERE idc_id = '$idc'";
	$results2 = mysql_query($query2) or die(mysql_error());
	#$array = mysql_fetch_array($results2, MYSQL_NUM);
	$counter = 0 ;
	$counter2 = 0;
	while($row2 = mysql_fetch_assoc($results2)):
		
		$counter += $row2['basic'];
		$counter += $row2['additional'];
		
	   // echo $row2['basic'];
    	//echo $row2['additional'];
    endwhile;

    return $counter;

}


function get_do_reimbursements($idc){
	
	$query2="SELECT * FROM tbl_dos WHERE idc_id = '$idc'";
	$results2 = mysql_query($query2) or die(mysql_error());
	#$array = mysql_fetch_array($results2, MYSQL_NUM);
	$counter = 0 ;
	$counter2 = 0;
	while($row2 = mysql_fetch_assoc($results2)):
		
		$counter += $row2['reimbursed'];
		
		
	   // echo $row2['basic'];
    	//echo $row2['additional'];
    endwhile;

    return $counter;
    
}


echo get_do_totals(12);
echo get_do_reimbursements(12);
?>