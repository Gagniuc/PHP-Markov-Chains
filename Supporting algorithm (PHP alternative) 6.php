<?php

//##############################################################################################
//# John Wiley & Sons, Inc.                                                                    #
//#                                                                                            #
//# Book:   Markov Chains: From Theory To Implementation And Experimentation                   #
//# Author: Dr. Paul Gagniuc                                                                   #
//# Data:   01/09/2016                                                                         #
//#                                                                                            #
//# Description:                                                                               #
//# Supporting algorithm 6. The computation of the steady state vector. The above formulas are #
//# used for computing the x and y components of the steady state vector. Note that iterations #
//# are not required.                                                                          #
//##############################################################################################

$P = array();
$v = array();

$P[1][1] = 0.2;
$P[1][2] = 0.625;
$P[2][1] = 0.8;
$P[2][2] = 0.375;

$a = $P[1][1];
$b = $P[2][2];

$x = (1 - $b) / (2 - ($a + $b));
$y = (1 - $a) / (2 - ($a + $b));

$v[0] = $x;
$v[1] = $y;

echo "Steady state vector v = [" . $v[0] . " | " . $v[1] . "]";
?>
