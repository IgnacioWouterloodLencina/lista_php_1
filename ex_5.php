<?php
function analisarTexto($texto) {




$qnt_texto = str_word_count($texto);
$qnt_caracteres = strlen($texto);
$qnt_vogais = preg_match_all('/[aeiouAEIOU]/', $texto);
$qnt_consoantes = preg_match_all('/[bcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ]/', $texto);

echo "Quantidade de palavras: " . $qnt_texto . "<br>";
echo "Quantidade de caracteres: " . $qnt_caracteres . "<br>";
echo "Quantidade de vogais: " . $qnt_vogais . "<br>";
echo "Quantidade de consoantes: " . $qnt_consoantes . "<br>";

}
$texto = "Brasileiro tudo chorao Argentina campea do mundo 2026";
analisarTexto($texto);
?>