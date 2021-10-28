<?php

//##############################################################################################
//# John Wiley & Sons, Inc.                                                                    #
//#                                                                                            #
//# Book:   Markov Chains: From Theory To Implementation And Experimentation                   #
//# Author: Dr. Paul Gagniuc                                                                   #
//# Data:   01/09/2016                                                                         #
//#                                                                                            #
//# Description:                                                                               #
//# Supporting algorithm 14. A 3-states Markov Chain simulator. The probability                #
//# values present inside a 3x3 transition matrix (P) are directly used for an                 #
//# automatic generation of the letter combination that make up the representation             #
//# of the jars. Thus, the three letter sequences have a calculated proportion of              #
//# “A”, “B” and “C” letters. The chance of a letter chosen at random from one of              #
//# the three sequences is directly dictated by the proportions of “A”, “B” and                #
//# “C” letters.                                                                               #
//##############################################################################################

$P = array();
$Jar = array();

$P[0][0] = "A";
$P[0][1] = "B";
$P[0][2] = "C";

$P[1][0] = 0.33;
$P[1][1] = 0.33;
$P[1][2] = 0.33;

$P[2][0] = 0;
$P[2][1] = 0.5;
$P[2][2] = 0.5;

$P[3][0] = 1;
$P[3][1] = 0;
$P[3][2] = 0;

for($j=0; $j<=3; $j++){
    $Jar[$j] = Fill_Jar($j);
    if($j>0){echo "Jar(".$j.")=(".$Jar[$j].")</br>";}
}

$draws = 20;
$a = Draw(1);

for ($i=1; $i<=$draws; $i++){
    for ($j=0; $j<=3; $j++){

        If ($a == $P[0][$j]) {
            $a = Draw($j + 1) ;
            $q = $q . $P[0][$j];
            $z = $z . ", Jar " . $P[0][$j] . "[" . $a . "]";
            $j=3;
        } 
    }
}

echo "Q = " . $q . "</br>";
echo "Z = " . $z;

function Draw($S) {
    srand(mktime());
    global $Jar;
    $randomly_choose = rand(1,strlen($Jar[$S])-1);
    $ball = substr($Jar[$S], $randomly_choose, 1);
    return $ball;
}

function Fill_Jar($S){
global $P;

$Ltot = 27;
$b = "";
    for ($i=0; $i<=2; $i++){
    $a = round($Ltot * $P[$S][$i]);
        for ($j=1; $j<=$a; $j++){
             $b = $b . $P[0][$i];
        }
    }
return $b;
}

?>
