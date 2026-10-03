<?php

function ordenarNomes($nomesString) {


    $nomes = explode(",", $nomesString);

    $nomes = array_map('trim', $nomes);

    sort($nomes);
    
    return $nomes;
}

$alunos = "Igacio, Presidio ,  Colin reels da silva, Palm";
print_r(ordenarNomes($alunos));

?>