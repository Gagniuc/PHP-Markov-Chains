<?php

//##############################################################################################
//# John Wiley & Sons, Inc.                                                                    #
//#                                                                                            #
//# Book:   Markov Chains: From Theory To Implementation And Experimentation                   #
//# Author: Dr. Paul Gagniuc                                                                   #
//# Data:   01/09/2016                                                                         #
//#                                                                                            #
//# Description:                                                                               #
//# Supporting algorithm 16. Transition probability tester. Previously, a sequence             #
//# of observations has been provided by a simulator. To test the accuracy of the              #
//# simulator, the sequence of observations is used for creating a transition matrix,          #
//# which is then compared with the original.                                                  #
//##############################################################################################

$P = array();

ExtractProb("BABDCBDCBABDCBCBDCBABABABDCBDCBDCBCBABABDCBDCBDCBABCBABCBDCBDCBDCBDCBABCBCBABABDCBDCBCBDCBCBDCBDCBAB");

$z = "<table border='1'>";
for($i=1; $i<=4; $i++){
$z .= "<tr>";
    for($j=1; $j<=4; $j++){
       $z .= "<td>" . Round($P[$i][$j], 2) . "</td>" ;
    }
$z .= "</tr>";
}
$z .= "</table>";
   
echo $z;

Function ExtractProb($s) {
global $P;

$Ea = "A";
$Eb = "B";
$Ec = "C";
$Ed = "D";

for($i=1; $i<=4; $i++){
    for($j=1; $j<=4; $j++){
        $P[$i][$j]=0;
    }
}

$Ta = 0;
$Tb = 0;
$Tc = 0;
$Td = 0;

for($i=1; $i<strlen($s)-1; $i++){

        $DI1 = substr($s, $i, 1);
        $DI2 = substr($s, $i+1, 1);

        If ($DI1 == $Ea) {$r = 1;}
        If ($DI1 == $Eb) {$r = 2;}
        If ($DI1 == $Ec) {$r = 3;}
        If ($DI1 == $Ed) {$r = 4;}
        If ($DI2 == $Ea) {$c = 1;}
        If ($DI2 == $Eb) {$c = 2;}
        If ($DI2 == $Ec) {$c = 3;}
        If ($DI2 == $Ed) {$c = 4;}

        $P[$r][$c] = $P[$r][$c] + 1;

        If ($DI1 == $Ea) {$Ta = $Ta + 1;}
        If ($DI1 == $Eb) {$Tb = $Tb + 1;}
        If ($DI1 == $Ec) {$Tc = $Tc + 1;}
        If ($DI1 == $Ed) {$Td = $Td + 1;}
}

for($i=1; $i<=4; $i++){
    for($j=1; $j<=4; $j++){
       If ($i == 1) {$P[$i][$j] = intval($P[$i][$j]) / $Ta;}
       If ($i == 2) {$P[$i][$j] = intval($P[$i][$j]) / $Tb;}
       If ($i == 3) {$P[$i][$j] = intval($P[$i][$j]) / $Tc;}
       If ($i == 4) {$P[$i][$j] = intval($P[$i][$j]) / $Td;}
    }
}
}
?>
