<?php

function calcularDesconto($preco) {

    if ($preco > 1000) {

        $desconto = $preco * 0.30;
        $preco_final = $preco - $desconto;

    } else if ($preco > 500) {

        $desconto = $preco * 0.20;
        $preco_final = $preco - $desconto;

    } else if ($preco > 100) {

        $desconto = $preco * 0.10;
        $preco_final = $preco - $desconto;

    } else {

        $preco_final = $preco;

    }

    echo "Preço final: R$ " . $preco_final;
}

calcularDesconto(100000);

?>