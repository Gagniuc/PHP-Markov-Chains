<?php

//##############################################################################################
//# John Wiley & Sons, Inc.                                                                    #
//#                                                                                            #
//# Book:   Markov Chains: From Theory To Implementation And Experimentation                   #
//# Author: Dr. Paul Gagniuc                                                                   #
//# Data:   01/09/2016                                                                         #
//#                                                                                            #
//# Description:                                                                               #
//# Supporting algorithm 3. The conversion of a sequence of observations to a transition       #
//# matrix. A 2x2 matrix is used for counting all the combinations of pairs of letters         #
//# (Da->b) in the sequence (Da->b is represented by joining two string variables, namely      #
//# DI1 and DI2). In parallel, the first letter of each pair (Na) is counted inside the        #
//# sequence (Na is represented by variable DI1). Next, the values from each element of the    #
//# 2x2 matrix are divided by the number of first letters found in the sequence. Depending     #
//# on the type of values (counts or probability values) stored inside, the same matrix is     #
//# then shown twice in a graphical format.                                                    #
//##############################################################################################

$M = array();

ExtractProb("SRRSRSRRSRSRRSS");

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


echo DrowMatrix(2, 2, $M, "(C)", "Count:");

for($i=1; $i<=2; $i++){
    for($j=1; $j<=2; $j++){
       If ($i == 1) {$M[$i][$j] = intval($M[$i][$j]) / $TB;}
       If ($i == 2) {$M[$i][$j] = intval($M[$i][$j]) / $TS;}
    }
}

echo DrowMatrix(2, 2, $M, "(P)", "Transition matrix M:");
}

Function DrowMatrix($ib, $jb, $M, $model, $msg) {
$ct = "";
$Eb = "S";
$Es = "R";

$ct .= "<table border='1'><tr>";
$ct .= "<td>" . $model . "</td><td>" . $Eb . "</td><td>" . $Es . "</td></tr>";

for($i=1; $i<=$ib; $i++){
	$ct .= "<tr>";
    	for($j=1; $j<=$jb; $j++){
    		$v = Round($M[$i][$j], 1);
        	If ($j == 1 and $i == 1) {$ct .= "<td>" . $Eb . "</td>";}
        	If ($j == 1 and $i == 2) {$ct .= "<td>" . $Es . "</td>";}
        	$ct .= "<td>" . $v . "</td>";   
    	}
$ct .= "</tr>";
}

$ct .= "</table>";
$rez = $msg . " M[" . $jb . "," . $ib . "]" . "</br>" . $ct . "</br>";

return $rez;
}
?>

