<?php
function gerarSenha($tamanho = 10) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%&';
    
    $senha = substr(str_shuffle($caracteres), 0, $tamanho);
    
    return $senha;
}

echo gerarSenha(12);
?>