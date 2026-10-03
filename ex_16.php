<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Analisador de Senhas</title>
</head>

<body>

    <form method="POST">

        <label for="senha">Digite a senha para análise:</label><br><br>

        <input type="text" id="senha" name="senha" style="width: 350px;" value="<?php echo isset($_POST['senha']) ? htmlspecialchars($_POST['senha']) : ''; ?>" required>
        <button type="submit">Analisar Senha</button>

    </form>


    <?php

    function analisarSenha($senha) {

        $tamanho = mb_strlen($senha, 'UTF-8');

        $maiusculas = preg_match_all('/[A-Z]/', $senha);

        $minusculas = preg_match_all('/[a-z]/', $senha);
        $numeros = preg_match_all('/[0-9]/', $senha);

        $especiais = preg_match_all('/[\W_]/', $senha);


        $pontos = 0;


        if ($tamanho >= 12) {

            $pontos += 3;

        } elseif ($tamanho >= 8) {

            $pontos += 2;
        } elseif ($tamanho >= 6) {

            $pontos += 1;

        }


        if ($maiusculas > 0) $pontos++;

        if ($minusculas > 0) $pontos++;

        if ($numeros > 0) $pontos++;

        if ($especiais > 0) $pontos++;


        if ($pontos >= 7) {

            $nivel = 'Muito Forte';

        } elseif ($pontos >= 5) {
            $nivel = 'Forte';

        } elseif ($pontos >= 3) {

            $nivel = 'Média';
        } else {

            $nivel = 'Fraca';

        }


        return [
            'maiusculas' => $maiusculas,

            'minusculas' => $minusculas,
            'numeros' => $numeros,

            'especiais' => $especiais,
            'tamanho' => $tamanho,

            'nivel' => $nivel
        ];

    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['senha'])) {

        $senhaInput = $_POST['senha'];

        $analise = analisarSenha($senhaInput);


        echo "<br><hr><h3>Resultado da Análise da Senha:</h3>";

        echo "<ul>";

        echo "<li><strong>Tamanho Total:</strong> {$analise['tamanho']} caracteres</li>";
        echo "<li><strong>Letras Maiúsculas:</strong> {$analise['maiusculas']}</li>";

        echo "<li><strong>Letras Minúsculas:</strong> {$analise['minusculas']}</li>";

        echo "<li><strong>Números:</strong> {$analise['numeros']}</li>";

        echo "<li><strong>Caracteres Especiais:</strong> {$analise['especiais']}</li>";

        echo "<li><strong>Nível de Segurança:</strong> <strong>{$analise['nivel']}</strong></li>";
        echo "</ul>";

    }

    ?>

</body>
</html>