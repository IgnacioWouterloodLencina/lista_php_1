<?php

function calcularFormula($x,$y){

if (($x + $y) == 0){
    return "nao da pa dividir por zero";
}

 return  ((($x * $x) + ($y * $y)) / ($x + $y));

}
echo calcularFormula(1,4);