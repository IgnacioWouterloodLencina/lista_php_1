<?php

function analisarNumero($numero) {
    $par = ($numero % 2 == 0) ? "Par" : "Ímpar";

    $divisores = 0;
    $soma = 0;
    for ($i = 1; $i < $numero; $i++) {
        if ($numero % $i == 0) {
            $divisores++;
            $soma += $i;
        }
    }

    $primo = ($divisores == 1) ? "Primo" : "Não é primo";
    $perfeito = ($soma == $numero && $numero > 0) ? "Perfeito" : "Não é perfeito";

    return "$par, $primo, $perfeito";
}

echo analisarNumero(28);

?>