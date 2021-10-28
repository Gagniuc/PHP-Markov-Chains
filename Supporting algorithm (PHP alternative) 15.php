<?php

//##############################################################################################
//# John Wiley & Sons, Inc.                                                                    #
//#                                                                                            #
//# Book:   Markov Chains: From Theory To Implementation And Experimentation                   #
//# Author: Dr. Paul Gagniuc                                                                   #
//# Data:   01/09/2016                                                                         #
//#                                                                                            #
//# Description:                                                                               #
//# Supporting algorithm 15. A Markov Chain framework for simulation.                          #
//# The probability values present inside a 4x4 transition matrix (P)                          #
//# are directly used for an automatic generation of the letter                                #
//# combination that make up the representation of four jars. Thus,                            #
//# the four letter sequences have a calculated proportion of “A”,                             #
//# “B”, “C” and “D” letters. The chance of a letter chosen at random                          #
//# from one of the four sequences is directly dictated by the                                 #
//# proportions of “A”, “B”, “C” and “D” letters.                                              #
//##############################################################################################

$P = array();
$Jar = array();

$P[0][0] = "A";
$P[0][1] = "B";
$P[0][2] = "C";
$P[0][3] = "D";

$P[1][0] = 0;
$P[1][1] = 1;
$P[1][2] = 0;
$P[1][3] = 0;

$P[2][0] = 0.33;
$P[2][1] = 0;
$P[2][2] = 0.33;
$P[2][3] = 0.33;

$P[3][0] = 0;
$P[3][1] = 1;
$P[3][2] = 0;
$P[3][3] = 0;

$P[4][0] = 0;
$P[4][1] = 0;
$P[4][2] = 1;
$P[4][3] = 0;

for($j=1; $j<=4; $j++){
    $Jar[$j] = Fill_Jar($j);
}

$draws = 100;
$a = Draw(1);

for ($i=1; $i<=$draws; $i++){
    for ($j=0; $j<=3; $j++){
        If ($a == $P[0][$j]){
            $a = Draw($j + 1) ;
            $q = $q . $P[0][$j];
            $j=3;
        } 
    }
}

echo "Q = " . $q . "</br>";

function Draw($S) {
    srand(mktime());
    global $Jar;
    $randomly_choose = rand(1,strlen($Jar[$S])-1);
    $ball = substr($Jar[$S], $randomly_choose, 1);
    return $ball;
}

function Fill_Jar($S){
global $P;

$Ltot = 100;
$b = "";
    for ($i=0; $i<=3; $i++){
    $a = round($Ltot * $P[$S][$i]);
        for ($j=1; $j<=$a; $j++){
             $b = $b . $P[0][$i];
        }
    }
return $b;
}
?>
