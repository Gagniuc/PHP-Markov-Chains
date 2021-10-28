<?php

//##############################################################################################
//# John Wiley & Sons, Inc.                                                                    #
//#                                                                                            #
//# Book:   Markov Chains: From Theory To Implementation And Experimentation                   #
//# Author: Dr. Paul Gagniuc                                                                   #
//# Data:   01/09/2016                                                                         #
//#                                                                                            #
//# Description:                                                                               #
//# Supporting algorithm 2. A two states Markov Chain simulator based on probability values.   #
//# The probability values present inside the transition matrix are directly used for an       #
//# automatic generation of the letter combination that make up the representation of the      #
//# jars. Thus, the two letter sequences have a calculated proportion of “W” and “B”           #
//# letters. The chance of a letter chosen at random from one of the two sequences             #
//# is directly dictated by the proportions of “W” and “B” letters.                            #
//##############################################################################################

$Jar = array();
$draws = 17;

Fill_Jar(0, 0.2);
Fill_Jar(1, 0.6);

$a = Draw(0);
$z = $z . " Jar W[" . $a . "],";

for ($i=1; $i<=$draws; $i++){
 
    If ($a == "W") {
        $a = Draw(0); 
        $z = $z . " Jar W[" . $a . "],";
    } else {
        $a = Draw(1); 
        $z = $z . " Jar B[" . $a . "],";
    }
}

echo $z;

function Draw($S) {
    srand(mktime());
    global $Jar;
    $randomly_choose = rand(1,strlen($Jar[$S])-1);
    $ball = substr($Jar[$S], $randomly_choose, 1);
    return $ball;
}

function Fill_Jar($S, $p){
global $Jar;

$Balls_W = round(100 * $p);
$Balls_B = 100 - $Balls_W;
 
for ($i=1; $i<=$Balls_W; $i++){
    $Jar[$S] = $Jar[$S] . "W"; 
}

for ($i=1; $i<=$Balls_B; $i++){
    $Jar[$S] = $Jar[$S] . "B"; 
} 
}
?>
