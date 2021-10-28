<?php

//##############################################################################################
//# John Wiley & Sons, Inc.                                                                    #
//#                                                                                            #
//# Book:   Markov Chains: From Theory To Implementation And Experimentation                   #
//# Author: Dr. Paul Gagniuc                                                                   #
//# Data:   01/09/2016                                                                         #
//#                                                                                            #
//# Description:                                                                               #
//# Supporting algorithm 10. Predictions based on sequences produced by n-state                #
//# Markov machines. This example also uses a DNA sequence as a model. However,                #
//# the algorithm allows for an unlimited number of letters (observations).                    #
//# Previously, the vector – matrix multiplication cycle was declared manually                 #
//# with a range of expressions. Here, the multiplication cycle is made                        #
//# iteratively. For a prediction on more than 4 states, the matrix elements                   #
//# and the number of vector components can be increased to cover a new                        #
//# prediction requirement. Note that “ExtractProb” function is not shown.                     #
//# However, when the above algorithm is used the “ExtractProb” function                       #
//# must be present.                                                                           #
//##############################################################################################

$M = array();
$v = array();

ExtractProb("TACTTCGATTTAAGCGCGGCGGCCTATATTA");

$chain = 5;

$v[0][0] = 1;
$v[1][0] = 0;
$v[2][0] = 0;
$v[3][0] = 0;

$v[0][1] = 0;
$v[1][1] = 0;
$v[2][1] = 0;
$v[3][1] = 0;

for($k=1; $k<=$chain; $k++){
    for($i=0; $i<=3; $i++){
        for($j=0; $j<=3; $j++){
           $v[$i][1] = $v[$i][1] + ($v[$j][0] * $M[$j + 1][$i + 1]);
        }
    }

for($i=0; $i<=3; $i++){
    $v[$i][0] = $v[$i][1];
    $v[$i][1] = 0;
}

    $A = $v[0][0];
    $T = $v[1][0];
    $G = $v[2][0];
    $C = $v[3][0];

echo "V(".$k.")=[".$A."|".$T."|".$G."|".$C."]</br>";
}

Function ExtractProb($s) {
global $M;

$Ea = "A";
$Et = "T";
$Eg = "G";
$Ec = "C";

for($i=1; $i<=4; $i++){
    for($j=1; $j<=4; $j++){
        $M[$i][$j]=0;
    }
}

$Ta = 0;
$Tt = 0;
$Tg = 0;
$Tc = 0;

for($i=1; $i<strlen($s)-1; $i++){

        $DI1 = substr($s, $i, 1);
        $DI2 = substr($s, $i+1, 1);

        If ($DI1 == $Ea) {$r = 1;}
        If ($DI1 == $Et) {$r = 2;}
        If ($DI1 == $Eg) {$r = 3;}
        If ($DI1 == $Ec) {$r = 4;}

        If ($DI2 == $Ea) {$c = 1;}
        If ($DI2 == $Et) {$c = 2;}
        If ($DI2 == $Eg) {$c = 3;}
        If ($DI2 == $Ec) {$c = 4;}

        $M[$r][$c] = $M[$r][$c] + 1;

        If ($DI1 == $Ea) {$Ta = $Ta + 1;}
        If ($DI1 == $Et) {$Tt = $Tt + 1;}
        If ($DI1 == $Eg) {$Tg = $Tg + 1;}
        If ($DI1 == $Ec) {$Tc = $Tc + 1;}
}

for($i=1; $i<=4; $i++){
    for($j=1; $j<=4; $j++){
       If ($i == 1) {$M[$i][$j] = intval($M[$i][$j]) / $Ta;}
       If ($i == 2) {$M[$i][$j] = intval($M[$i][$j]) / $Tt;}
       If ($i == 3) {$M[$i][$j] = intval($M[$i][$j]) / $Tg;}
       If ($i == 4) {$M[$i][$j] = intval($M[$i][$j]) / $Tc;}
    }
}
}
?>
