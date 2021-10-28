<?php

//##############################################################################################
//# John Wiley & Sons, Inc.                                                                    #
//#                                                                                            #
//# Book:   Markov Chains: From Theory To Implementation And Experimentation                   #
//# Author: Dr. Paul Gagniuc                                                                   #
//# Data:   01/09/2016                                                                         #
//#                                                                                            #
//# Description:                                                                               #
//# Supporting algorithm 1. A two states Markov Chain simulator based on the proportions of    #
//# letters. Two letter sequences with predetermined proportions of “W” and “B” letters are    #
//# used for the representation of two jars. The chance of a letter chosen at random from      #
//# one of the two sequences is directly dictated by the proportions of “W” and “B” letters.   #
//##############################################################################################

$Jar = array();
$draws = 17;

$Jar[0] = "WWBBBBBBBB";
$Jar[1] = "WWWWWBBBBB";

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

?>
