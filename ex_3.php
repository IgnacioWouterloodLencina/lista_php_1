<?php
function mascararCpf($string) {
    return str_repeat('*', strlen($string));
}


$senha = "minhasenha123";
echo mascararCpf($senha);