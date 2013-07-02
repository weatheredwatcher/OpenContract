<?php

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

$today = date('M');

echo get_quarter($today);


?>