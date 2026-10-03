<?php

function analisarProdutos($produtos, $busca) {
    $maisCaro = "";
    $maisBarato = "";

    $precoCaro = -1;

    $precoBarato = PHP_FLOAT_MAX;
    $soma = 0;

    $encontrado = "Produto não encontrado";

    foreach ($produtos as $nome => $preco) {
        $soma += $preco;


        if ($preco > $precoCaro) {
            $precoCaro = $preco;
            $maisCaro = $nome;

        }

        if ($preco < $precoBarato) {
            $precoBarato = $preco;



            $maisBarato = $nome;
        }

        if (strtolower($nome) == strtolower($busca)) {
            $encontrado = "$nome encontrado por R$ $preco";
        }
    }

    $media = $soma / count($produtos);

    

    return "Mais caro: $maisCaro (R$ $precoCaro) | Mais barato: $maisBarato (R$ $precoBarato) | Média: R$ $media | Pesquisa: $encontrado";
}


$catalogo = [
    "Arroz" => 25.50,
    "Feijão" => 8.90,
    "Café" => 16.00,
    "Leite" => 4.50
];

echo analisarProdutos($catalogo, "Feijão");

?>