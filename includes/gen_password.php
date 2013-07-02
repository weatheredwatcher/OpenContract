<?php

function gen_password(){
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


        $pword1 = $word[mt_rand(0, 20)];
        $pword2 = $word[mt_rand(0, 20)];

        if($pword2 == $pword1){
                $pword2 = $word[mt_rand(0, 20)];
}
        $pnum = mt_rand(2,9).mt_rand(2,8);

//      $pword = $word[rand(0, 20)].rand(2,9).rand(2,9).$word[rand(0, 20)];

        $pword = $pword1.$pnum.$pword2;

return $pword;

	}

	echo gen_password();

	?>