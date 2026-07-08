<?php
function mascararCpf($string) {
    return str_repeat('*', strlen($string) - 4) . substr($string, -4);
}


$cpf = "498487949";
echo mascararCpf($cpf);

?>