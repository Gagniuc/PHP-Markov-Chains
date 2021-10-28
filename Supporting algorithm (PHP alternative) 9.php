<?php

//##############################################################################################
//# John Wiley & Sons, Inc.                                                                    #
//#                                                                                            #
//# Book:   Markov Chains: From Theory To Implementation And Experimentation                   #
//# Author: Dr. Paul Gagniuc                                                                   #
//# Data:   01/09/2016                                                                         #
//#                                                                                            #
//# Description:                                                                               #
//# Supporting algorithm 9. Step-by-step prediction by using a DNA sequence.                   #
//# The letters that make up a DNA sequence are: “A”, “T”, “G” and “C”. Thus,                  #
//# the observations present in a DNA sequence are suitable for exemplifications               #
//# involving a 4-state Markov machine. As before, a 4x4 matrix is used for                    #
//# counting all the combinations of pairs of letters (Da->b) in the DNA                       #
//# sequence (Da->b is represented by joining two string variables, namely                     #
//# DI1 and DI2). In parallel, the first letter (Na) of each pair is counted                   #
//# inside the DNA sequence (Na is represented by variable DI1). Secondly,                     #
//# the transition probabilities are computed. The values from each element                    #
//# of the matrix are divided by their corresponding Na. In the final phase,                   #
//# a probability vector is repeatedly multiplied by the new transition matrix.                #
//# The vectors obtained from these repetitions show the probability of each                   #
//# outcome on a particular step.                                                              #
//##############################################################################################

$M = array();
$v = array();

ExtractProb("TACTTCGATTTAAGCGCGGCGGCCTATATTA");

$chain = 3;

$v[0] = 1;
$v[1] = 0;
$v[2] = 0;
$v[3] = 0;

for($i=1; $i<=$chain; $i++){
    
$x=($v[0]*$M[1][1])+($v[1]*$M[2][1])+($v[2]*$M[3][1])+($v[3]*$M[4][1]);
$y=($v[0]*$M[1][2])+($v[1]*$M[2][2])+($v[2]*$M[3][2])+($v[3]*$M[4][2]);
$z=($v[0]*$M[1][3])+($v[1]*$M[2][3])+($v[2]*$M[3][3])+($v[3]*$M[4][3]);
$w=($v[0]*$M[1][4])+($v[1]*$M[2][4])+($v[2]*$M[3][4])+($v[3]*$M[4][4]);

    $v[0] = $x;
    $v[1] = $y;
    $v[2] = $z;
    $v[3] = $w;

echo "Base(".$i.")=[".$v[0]."|".$v[1]."|".$v[2]."|".$v[3]."]</br>";
$Baseby = $Baseby . Base($v);
}

echo "BasesPredicted[" . $Baseby . "]";

Function Base($v){
  for($i=0; $i<=count($v); $i++){
     If ($v[$i] > $old){
         $x = $v[$i];
         $h = $i;
     } 
     $old = $x;
  }
     If ($h == 0) {$n = "A";}
     If ($h == 1) {$n = "T";}
     If ($h == 2) {$n = "G";}
     If ($h == 3) {$n = "C";}  
     Return $n;
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
