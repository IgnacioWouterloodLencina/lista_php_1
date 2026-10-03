<?php

function calcularMedia($notas) {
    $maior = max($notas);
    $menor = min($notas);
    $media = array_sum($notas) / count($notas);

    if ($media >= 7) {
        $situacao = "Aprovado";
    } else if ($media >= 5) {
        $situacao = "Recuperação";
    } else {
        $situacao = "Reprovado";
    }

    return "Maior: $maior, Menor: $menor, Média: $media, Situação: $situacao";
}

echo calcularMedia([8, 6.5, 9, 7.5]);

?>