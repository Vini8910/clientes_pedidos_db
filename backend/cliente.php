<?php
include 'conexao.php';

$con = conectar();
$action = $_POST['action'];

if ($action == 'salvar_cliente') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];

    $query = "INSERT INTO CLIENTES (NOME, CPF_CNPJ, EMAIL, DATA_CADASTRO) VALUES (?, ?, ?, CURRENT_DATE)";
    $stmt = ibase_prepare($con, $query);
    ibase_execute($stmt, $nome, $cpf, $email);
    echo json_encode(['status' => 'ok']);
}

if ($action == 'listar_clientes') {
    $res = ibase_query($con, "SELECT ID, NOME FROM CLIENTES ORDER BY NOME");
    $clientes = [];
    while ($row = ibase_fetch_assoc($res)) {
        $clientes[] = $row;
    }
    echo json_encode($clientes);
}
?>