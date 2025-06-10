<?php
    require_once '../init.php';

    $Id = isset($_GET['Id']) ? $_GET['Id'] : null;

    if (empty($Id)) {
        header('Location: ../msg/msgErro.html');
        exit;
    }

    $PDO = db_connect();
    $stmtPedido->execute();
    $stmt = $PDO->prepare($sql);
    $sql = "DELETE FROM Produto_Compra WHERE Id = :Id";
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: ../msg/msgSucessoCompra.html');
    } else {
        header('Location: ../msg/msgErro.html');
    }
    exit;

?>