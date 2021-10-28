<?php

//##############################################################################################
//# John Wiley & Sons, Inc.                                                                    #
//#                                                                                            #
//# Book:   Markov Chains: From Theory To Implementation And Experimentation                   #
//# Author: Dr. Paul Gagniuc                                                                   #
//# Data:   01/09/2016                                                                         #
//#                                                                                            #
//# Description:                                                                               #
//# Supporting algorithm 7. Step-by-step prediction using a sequence of observations           #
//# made by a 2-state Markov machine. First, a 2x2 matrix is used for counting all             #
//# the combinations of pairs of letters (Da->b) in the sequence (Da->b is represented         #
//# by joining two string variables, namely DI1 and DI2). In parallel, the first               #
//# letter (Na) of each pair is counted inside the sequence (Na is represented by              #
//# variable DI1). Secondly, the transition probabilities are computed. The values             #
//# from each element of the matrix are divided by the corresponding Na. In the                #
//# final phase, a probability vector is repeatedly multiplied by the new                      #
//# transition matrix. The vectors obtained from these repetitions show the                    #
//# probability of each outcome on a particular step.                                          #
//##############################################################################################

$M = array();
$v = array();

ExtractProb("SRRSRSRRSRSRRSS");

$chain = 5;

$v[0] = 1;
$v[1] = 0;

for($i=1; $i<=$chain; $i++){
    $x = ($v[0] * $M[1][1]) + ($v[1] * $M[2][1]);
    $y = ($v[0] * $M[1][2]) + ($v[1] * $M[2][2]);
    
    $v[0] = $x;
    $v[1] = $y;
    
    echo "Day(" . $i . ")=[" . $v[0] . " - " . $v[1] . "]</br>";
}


Function ExtractProb($s) {
global $M;

$Eb = "S";
$Es = "R";

for($i=1; $i<=2; $i++){
    for($j=1; $j<=2; $j++){
        $M[$i][$j]=0;
    }
}

$TB = 0;
$TS = 0;

for($i=1; $i<strlen($s)-1; $i++){

        $DI1 = substr($s, $i, 1);
        $DI2 = substr($s, $i+1, 1);

        If ($DI1 == $Eb) {$r = 1;}
        If ($DI1 == $Es) {$r = 2;}
        If ($DI2 == $Eb) {$c = 1;}
        If ($DI2 == $Es) {$c = 2;}

        $M[$r][$c] = $M[$r][$c] + 1;

        If ($DI1 == $Eb) {$TB = $TB + 1;}
        If ($DI1 == $Es) {$TS = $TS + 1;}
}

for($i=1; $i<=2; $i++){
    for($j=1; $j<=2; $j++){
       If ($i == 1) {$M[$i][$j] = intval($M[$i][$j]) / $TB;}
       If ($i == 2) {$M[$i][$j] = intval($M[$i][$j]) / $TS;}
    }
}

}
?>
