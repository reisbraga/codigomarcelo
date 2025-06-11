<?php
require_once '../init.php';

$Id = isset($_GET['idCompra']) ? $_GET['idCompra'] : null;

if (empty($Id)) {
    header('Location: ../msg/msgErro.html');
    exit;
}

$PDO = db_connect();

// Verificar se existe algum pedido para esta compra
$sqlPedido = "SELECT COUNT(*) AS total FROM Produto_Compra WHERE Compra_idCompra = :Id";
$stmtPedido = $PDO->prepare($sqlPedido);
$stmtPedido->bindParam(':Id', $Id, PDO::PARAM_INT);
$stmtPedido->execute();
$total = $stmtPedido->fetchColumn();

if ($total > 0) {
    header('Location: ../msg/msgErro.html');
    exit;

} else {
    $sql = "DELETE FROM Compra WHERE idCompra = :Id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        header('Location: ../msg/msgSucesso.html');
    } else {
        header('Location: ../msg/msgErro.html');
    }
    exit;
}
?>