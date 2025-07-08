<?php
function conectar() {
    $host = 'localhost:/caminho/para/seu_banco.fdb';
    $usuario = 'SYSDBA';
    $senha = 'masterkey';

    return ibase_connect($host, $usuario, $senha);
}
?>