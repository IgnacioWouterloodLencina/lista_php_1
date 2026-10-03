<?php

function calcularIMC($peso, $altura) {
    return round($peso / ($altura * $altura), 2);
}

function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) ? "Válido" : "Inválido";
}

function gerarSenhaAleatoria($tamanho = 8) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%";
    return substr(str_shuffle($chars), 0, $tamanho);
}

function contarVogais($texto) {
    preg_match_all('/[aeiouáéíóúâêîôûãõ]/i', $texto, $matches);
    return count($matches[0]);
}

function inverterTexto($texto) {
    return strrev($texto);
}

function calcularIdade($dataNascimento) {
    $nasc = new DateTime($dataNascimento);
    $hoje = new DateTime();
    return $nasc->diff($hoje)->y;
}

function converterMoeda($valor, $taxa) {
    return number_format($valor * $taxa, 2, ',', '.');
}

function formatarTelefone($num) {
    return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $num);
}

function gerarSaudacao($hora) {
    if ($hora >= 5 && $hora < 12) return "Bom dia!";
    if ($hora >= 12 && $hora < 18) return "Boa tarde!";
    return "Boa noite!";
}

function validarSenhaForte($senha) {
    $forte = strlen($senha) >= 8 && preg_match('/[A-Z]/', $senha) && preg_match('/[0-9]/', $senha);
    return $forte ? "Forte" : "Fraca";
}

?>