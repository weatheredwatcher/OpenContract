#!/usr/bin/php
<?php
# password dictionary;
$word[0] = "book";
$word[1] = "note";
$word[2] = "van";
$word[3] = "boat";
$word[4] = "ship";
$word[5] = "train";
$word[6] = "tank";
$word[7] = "bus";
$word[8] = "sedan";
$word[9] = "wagon";
$word[10] = "sloop";
$word[11] = "tug";
$word[12] = "pickup";
$word[13] = "bike";
$word[14] = "bird";
$word[15] = "note";
$word[16] = "float";
$word[17] = "brick";
$word[18] = "bat";
$word[19] = "hard";
$word[20] = "hat";


$debug = FALSE;
//$debug = TRUE;

$dbhost = "localhost";
$dbuser = "root";
$dbpword = "";
$dbname = "SFM_assignments";
$dbtable = "Logins_new";

$conn = mysql_connect($dbhost, $dbuser, $dbpword);

if ($conn)
        mysql_select_db($dbname);


$datafile = "assign_login.csv";

$handle = fopen($datafile, "rb");

if(!$handle)
{
        echo "Can't open datafile ".$datafile;
        exit();
}

# Only if table is empty!
mysql_query("ALTER TABLE $dbtable AUTO_INCREMENT = 1");

$i = 0;

while ($tmp = fgetcsv($handle, 1000))
{
        srand($i++);
	
        $pword1 = $word[rand(0, 20)];
        $pword2 = $word[rand(0, 20)];

        if($pword2 == $pword1)
                $pword2 = $word[rand(0, 20)];

        $pnum = rand(2,9).rand(2,8);

//      $pword = $word[rand(0, 20)].rand(2,9).rand(2,9).$word[rand(0, 20)];

        $pword = $pword1.$pnum.$pword2;


	if($tmp[1] == "")
		$code = $tmp[0];
	else
		$code = trim($tmp[1]);
		
	$sql = "INSERT into $dbtable (Code, PWord) VALUES ('$code', '$pword')";
	
	if($debug)
		echo $sql."\n";
	else
	{
		$res = mysql_query($sql);
		
		if (!$res)
			echo mysql_error()."\n";
		else
			echo ".";
	}
}

?>