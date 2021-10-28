<?php

//##############################################################################################
//# John Wiley & Sons, Inc.                                                                    #
//#                                                                                            #
//# Book:   Markov Chains: From Theory To Implementation And Experimentation                   #
//# Author: Dr. Paul Gagniuc                                                                   #
//# Data:   01/09/2016                                                                         #
//#                                                                                            #
//# Description:                                                                               #
//# Supporting algorithm 11. The conversion of measurements to states.                         #
//# A range of values is divided into 4 equal regions. Each region                             #
//# corresponds to a state: “A”, “B”, “C”, and “D”. The numeric values                         #
//# are associated with a representative letter based on their position                        #
//# over the regions. Thus, the initial values are listed as letters (observations).           #
//##############################################################################################

$Inp = array();
$Obs = "";
$Reg = "";
$l="";

$R = "159";

$Inp = explode(",",$R);
$Lu = 200;
$Ld = 60;
$n = 4;

$Pr = ($Lu - $Ld) / $n;

for($i=0; $i<count($Inp); $i++){

    $s = ($Inp[$i] - $Ld) / $Pr;
    $s = floor($s);

    if($s == 0){$l = "A";} 
    if($s == 1){$l = "B";}
    if($s == 2){$l = "C";}
    if($s == 3){$l = "D";}

    $Obs = $Obs . $l;
    $Reg = $Reg . $s . ",";
}

echo "Reg=" . $Reg . "</br>" . "Obs=" . $Obs . "</br>";

?>
