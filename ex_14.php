<?php

function estatisticasNumericas($n) {
    sort($n);
    $qtd = count($n);
    $meio = floor($qtd / 2);
    $mediana = ($qtd % 2 == 0) ? ($n[$meio - 1] + $n[$meio]) / 2 : $n[$meio];

    $pares = count(array_filter($n, fn($x) => $x % 2 == 0));
    $impares = $qtd - $pares;

    return "Soma: " . array_sum($n) . 
           " | Média: " . (array_sum($n) / $qtd) . 
           " | Maior: " . max($n) . 
           " | Menor: " . min($n) . 
           " | Mediana: $mediana | Pares: $pares | Ímpares: $impares";
}

echo estatisticasNumericas([10, 2, 5, 8, 1, 4]);

?>