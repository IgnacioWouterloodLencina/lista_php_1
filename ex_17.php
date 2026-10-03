<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Estatísticas de Texto</title>
</head>

<body>

    <form method="POST">

        <label for="texto">Digite ou cole o texto para análise:</label><br><br>

        <textarea id="texto" name="texto" rows="6" cols="60" required><?php echo isset($_POST['texto']) ? htmlspecialchars($_POST['texto']) : ''; ?></textarea><br><br>

        <button type="submit">Analisar Texto</button>

    </form>


    <?php

    function limparEspacosExtras($texto) {

        return trim(preg_replace('/\s+/', ' ', $texto));

    }


    function extrairPalavrasLimpas($texto) {

        $textoLimpo = mb_strtolower($texto, 'UTF-8');

        $textoLimpo = preg_replace('/[^\w\sà-úÀ-Ú]/u', '', $textoLimpo);

        $palavras = explode(' ', $textoLimpo);

        return array_values(array_filter($palavras, function($p) {

            return $p !== '';
        }));

    }


    function contarFrases($texto) {

        preg_match_all('/[.!?]+/', $texto, $matches);

        $total = count($matches[0]);


        return $total > 0 ? $total : 1;

    }


    function encontrarExtremosPalavras($palavras) {

        if (empty($palavras)) {

            return ['longa' => '', 'curta' => ''];
        }

        $longa = $palavras[0];

        $curta = $palavras[0];


        foreach ($palavras as $p) {

            if (mb_strlen($p, 'UTF-8') > mb_strlen($longa, 'UTF-8')) {

                $longa = $p;
            }

            if (mb_strlen($p, 'UTF-8') < mb_strlen($curta, 'UTF-8')) {

                $curta = $p;
            }

        }


        return ['longa' => $longa, 'curta' => $curta];

    }


    function analisarFrequenciaPalavras($palavras) {

        $frequencias = array_count_values($palavras);

        $repetidas = 0;


        foreach ($frequencias as $qtd) {

            if ($qtd > 1) {

                $repetidas++;
            }

        }

        arsort($frequencias);

        $top5 = array_slice($frequencias, 0, 5, true);


        return [
            'repetidas' => $repetidas,

            'top5' => $top5

        ];

    }


    function formatarPrimeiraMaiuscula($texto) {

        return mb_convert_case($texto, MB_CASE_TITLE, 'UTF-8');

    }


    function processarTexto($texto) {

        $textoSemEspacos = limparEspacosExtras($texto);

        $palavras = extrairPalavrasLimpas($textoSemEspacos);


        $extremos = encontrarExtremosPalavras($palavras);

        $frequencias = analisarFrequenciaPalavras($palavras);


        return [
            'caracteres' => mb_strlen($texto, 'UTF-8'),

            'palavras' => count($palavras),

            'frases' => contarFrases($texto),

            'palavra_longa' => $extremos['longa'],

            'palavra_curta' => $extremos['curta'],

            'palavras_repetidas' => $frequencias['repetidas'],

            'top5_frequentes' => $frequencias['top5'],

            'texto_limpo' => $textoSemEspacos,

            'texto_formatado' => formatarPrimeiraMaiuscula($textoSemEspacos)

        ];

    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['texto'])) {

        $textoEntrada = $_POST['texto'];

        $estatisticas = processarTexto($textoEntrada);


        echo "<br><hr><h3>Estatísticas do Texto:</h3>";

        echo "<ul>";

        echo "<li><strong>Quantidade de Caracteres:</strong> {$estatisticas['caracteres']}</li>";

        echo "<li><strong>Quantidade de Palavras:</strong> {$estatisticas['palavras']}</li>";

        echo "<li><strong>Quantidade de Frases:</strong> {$estatisticas['frases']}</li>";

        echo "<li><strong>Palavra Mais Longa:</strong> " . htmlspecialchars($estatisticas['palavra_longa']) . "</li>";

        echo "<li><strong>Palavra Mais Curta:</strong> " . htmlspecialchars($estatisticas['palavra_curta']) . "</li>";

        echo "<li><strong>Quantidade de Palavras Repetidas:</strong> {$estatisticas['palavras_repetidas']}</li>";


        echo "<li><strong>5 Palavras Mais Frequentes:</strong><ul>";

        foreach ($estatisticas['top5_frequentes'] as $palavra => $qtd) {

            echo "<li>" . htmlspecialchars($palavra) . ": {$qtd}x</li>";

        }

        echo "</ul></li>";


        echo "<li><strong>Texto sem Espaços Duplicados:</strong> " . htmlspecialchars($estatisticas['texto_limpo']) . "</li>";

        echo "<li><strong>Texto Formatado (Título):</strong> " . htmlspecialchars($estatisticas['texto_formatado']) . "</li>";

        echo "</ul>";

    }

    ?>

</body>
</html>