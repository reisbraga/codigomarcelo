<?php
require_once '../init.php';

$Id = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : null;

if (empty($Id)) {
    header('Location: ../msg/msgErro.html');
    exit;
}

$PDO = db_connect();

// Verificar se existe alguma compra para este cliente
$sqlCompra = "SELECT COUNT(*) AS total FROM Compra WHERE Usuario_idUsuario = :Id";
$stmtCompra = $PDO->prepare($sqlCompra);
$stmtCompra->bindParam(':Id', $Id, PDO::PARAM_INT);
$stmtCompra->execute();
$total = $stmtCompra->fetchColumn();

if ($total > 0) {
    header('Location: ../msg/msgErro.html');
    exit;

} else {
    $sql = "DELETE FROM Usuario WHERE idUsuario = :Id";
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