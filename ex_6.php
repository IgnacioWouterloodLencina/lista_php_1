<?php

function converterTemperatura($temperatura) {
    $fahrenheit = ($temperatura * 1.8) + 32; 

    echo "celcio: " . $temperatura . "<br>";
    echo "farenrrait: " . $fahrenheit . "<br>";
 
}
$temperatura = 0;
converterTemperatura($temperatura);

?>