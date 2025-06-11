<?php
    require_once '../init.php';


    $Id = isset($_GET['Produto_idProduto']) ? $_GET['Produto_idProduto'] : null;

    if (empty($Id)) {
        header('Location: ../msg/msgErro.html');
        exit;
    }

    $PDO = db_connect();

    $sql = "DELETE FROM Produto_Compra WHERE Produto_idProduto = :Id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: ../msg/msgSucesso.html');
    } else {
        header('Location: ../msg/msgErro.html');
    }
    exit;
    

?>