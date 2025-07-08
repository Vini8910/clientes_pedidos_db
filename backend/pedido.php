<?php
include 'conexao.php';

$con = conectar();
$action = $_POST['action'];

if ($action == 'salvar_pedido') {
    $id_cliente = $_POST['id_cliente'];
    $data = $_POST['data'];
    $valor = $_POST['valor'];
    $status = $_POST['status'];

    $stmt = ibase_prepare($con, "EXECUTE PROCEDURE PRC_SALVAR_PEDIDO(?, ?, ?, ?)");
    ibase_execute($stmt, $id_cliente, $data, $valor, $status);
    echo json_encode(['status' => 'ok']);
}

if ($action == 'listar_pedidos') {
    $id_cliente = $_POST['id_cliente'];
    $res = ibase_query($con, "SELECT * FROM PEDIDOS WHERE ID_CLIENTE = $id_cliente ORDER BY DATA_PEDIDO DESC");
    $pedidos = [];
    while ($row = ibase_fetch_assoc($res)) {
        $pedidos[] = $row;
    }
    echo json_encode($pedidos);
}
?>