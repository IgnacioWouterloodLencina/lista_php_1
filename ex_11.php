<?php

function formatarTexto($texto) {
    $maiusculas = mb_strtoupper($texto);
    $minusculas = mb_strtolower($texto);
    $primeirasMaiusculas = mb_convert_case($texto, MB_CASE_TITLE);
    $quantidadeCaracteres = mb_strlen($texto);

    return [
        "maiusculas" => $maiusculas,
        "minusculas" => $minusculas,
        "primeiras_maiusculas" => $primeirasMaiusculas,
        "total_caracteres" => $quantidadeCaracteres
    ];
}

print_r(formatarTexto("relatório de vendas"));

?>