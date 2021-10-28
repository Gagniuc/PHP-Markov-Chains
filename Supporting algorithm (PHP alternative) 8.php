<?php

//##############################################################################################
//# John Wiley & Sons, Inc.                                                                    #
//#                                                                                            #
//# Book:   Markov Chains: From Theory To Implementation And Experimentation                   #
//# Author: Dr. Paul Gagniuc                                                                   #
//# Data:   01/09/2016                                                                         #
//#                                                                                            #
//# Description:                                                                               #
//# Supporting algorithm 8. Step-by-step prediction using a sequence of observations           #
//# made by a 3-state Markov machine. First, a 3x3 matrix is used for counting all             #
//# the combinations of pairs of letters (Da->b) in the sequence (Da->b is represented         #
//# by joining two string variables, namely DI1 and DI2). In parallel, the first               #
//# letter (Na) of each pair is counted inside the sequence (Na is represented by              #
//# variable DI1). Secondly, the transition probabilities are computed. The values             #
//# from each element of the matrix are divided by their corresponding Na. In the              #
//# final phase, a probability vector is repeatedly multiplied by the new transition           #
//# matrix. The vectors obtained from these repetitions show the probability of each           #
//# outcome on a particular step.                                                              #
//##############################################################################################

$M = array();
$v = array();

ExtractProb("SRCCRRSSCSRCSR");

$chain = 5;

$v[0] = 0;
$v[1] = 1;
$v[2] = 0;

for($i=1; $i<=$chain; $i++){
    $x = ($v[0] * $M[1][1]) + ($v[1] * $M[2][1]) + ($v[2] * $M[3][1]);
    $y = ($v[0] * $M[1][2]) + ($v[1] * $M[2][2]) + ($v[2] * $M[3][2]);
    $z = ($v[0] * $M[1][3]) + ($v[1] * $M[2][3]) + ($v[2] * $M[3][3]);

    $v[0] = $x;
    $v[1] = $y;
    $v[2] = $z;
    
echo "Day(" . $i . ")=[" . $v[0] . "|" . $v[1] . "|" . $v[2] . "]</br>";
}

Function ExtractProb($s) {
global $M;

$Eb = "S";
$Es = "R";
$Ec = "C";

for($i=1; $i<=3; $i++){
    for($j=1; $j<=3; $j++){
        $M[$i][$j]=0;
    }
}

$TB = 0;
$TS = 0;
$TC = 0;

for($i=1; $i<strlen($s)-1; $i++){

        $DI1 = substr($s, $i, 1);
        $DI2 = substr($s, $i+1, 1);

        If ($DI1 == $Eb) {$r = 1;}
        If ($DI1 == $Es) {$r = 2;}
        If ($DI1 == $Ec) {$r = 3;}
        If ($DI2 == $Eb) {$c = 1;}
        If ($DI2 == $Es) {$c = 2;}
        If ($DI2 == $Ec) {$c = 3;}

        $M[$r][$c] = $M[$r][$c] + 1;

        If ($DI1 == $Eb) {$TB = $TB + 1;}
        If ($DI1 == $Es) {$TS = $TS + 1;}
        If ($DI1 == $Ec) {$TC = $TC + 1;}
}

for($i=1; $i<=3; $i++){
    for($j=1; $j<=3; $j++){
       If ($i == 1) {$M[$i][$j] = intval($M[$i][$j]) / $TB;}
       If ($i == 2) {$M[$i][$j] = intval($M[$i][$j]) / $TS;}
       If ($i == 3) {$M[$i][$j] = intval($M[$i][$j]) / $TC;}
    }
}
}
?>
