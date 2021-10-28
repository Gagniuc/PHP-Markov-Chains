<?php

//##############################################################################################
//# John Wiley & Sons, Inc.                                                                    #
//#                                                                                            #
//# Book:   Markov Chains: From Theory To Implementation And Experimentation                   #
//# Author: Dr. Paul Gagniuc                                                                   #
//# Data:   01/09/2016                                                                         #
//#                                                                                            #
//# Description:                                                                               #
//# Supporting algorithm 17. Average time tester. The tester is composed                       #
//# of a simulator that generates 10,000 observations. These observations                      #
//# are then analyzed and the frequencies of “A”, “B”, “C” and “D” letters                     #
//# are determined. These frequencies represent the average time spent in                      #
//# each state.                                                                                #
//##############################################################################################

$P = array();
$Jar = array();
$f = array();

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

$draws = 10000;
$a = Draw(2);

for ($i=1; $i<=$draws; $i++){
    for ($j=0; $j<=3; $j++){
        If ($a == $P[0][$j]){
            $a = Draw($j + 1) ;
            $z .= $a;
            $j=3;
        } 
    }
}

for($i=1; $i<strlen($z); $i++){
    $g = substr($z, $i, 1); 
    If ($g == "A"){$f[0] = $f[0] + 1;} 
    If ($g == "B"){$f[1] = $f[1] + 1;}
    If ($g == "C"){$f[2] = $f[2] + 1;}
    If ($g == "D"){$f[3] = $f[3] + 1;}
}

for($i=0; $i<=3; $i++){
$pro .= $P[0][$i] . "=" . round((100 / strlen($z)) * $f[$i]) . "%&emsp;";
}

echo $pro;

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
