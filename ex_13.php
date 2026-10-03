<?php

function criptografarMensagem($texto, $deslocamento = 3) {
    $resultado = "";
    for ($i = 0; $i < strlen($texto); $i++) {
        $c = $texto[$i];
        if (ctype_alpha($c)) {
            $base = ctype_upper($c) ? 65 : 97;
            $c = chr(($ord = ord($c) - $base + $deslocamento) % 26 + $base);
        }
        $resultado .= $c;
    }
    return $resultado;
}

function descriptografarMensagem($texto, $deslocamento = 3) {
    return criptografarMensagem($texto, 26 - ($deslocamento % 26));
}

$mensagem = "AULA DE PHP";
$cripto = criptografarMensagem($mensagem);
$original = descriptografarMensagem($cripto);

echo "Criptografado: $cripto | Original: $original";

?>