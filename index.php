<?php

require_once "funcoes.php";

echo "IMC: " . calcularIMC(70, 1.75) . "<br>";
echo "E-mail: " . validarEmail("teste@email.com") . "<br>";
echo "Senha gerada: " . gerarSenhaAleatoria(10) . "<br>";
echo "Vogais: " . contarVogais("Desenvolvimento PHP") . "<br>";
echo "Invertido: " . inverterTexto("PHP") . "<br>";
echo "Idade: " . calcularIdade("2000-05-15") . " anos<br>";
echo "Conversão Moeda: R$ " . converterMoeda(100, 5.20) . "<br>";
echo "Telefone: " . formatarTelefone("11987654321") . "<br>";
echo "Saudação: " . gerarSaudacao(14) . "<br>";
echo "Validação Senha: " . validarSenhaForte("Senha123") . "<br>";

?>