<?php
    require_once '../init.php';

    $Id = isset($_POST['Id']) ? $_POST['Id'] : null;
    $nomeproduto = isset($_POST['nomeproduto']) ? $_POST['nomeproduto'] : null;
    $preco = isset($_POST['preco']) ? $_POST['preco'] : null;
    $qtdestoque = isset($_POST['qtdestoque']) ? $_POST['qtdestoque'] : null;
    $desc = isset($_POST['desc']) ? $_POST['desc'] : null;

    if (empty($Id) || empty($nomeproduto) || empty($preco) || empty($qtdestoque) || empty($desc)) {
        header('Location: ../msg/msgErro.html');
        exit;
    }

    $PDO = db_connect();
    $sql = "UPDATE Produto SET NmProduto = :nomeproduto, PrecoProduto = :preco, QtdEstoqueProduto = :qtdestoque, DescProduto = :desc WHERE idProduto = :Id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':nomeproduto', $nomeproduto);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':qtdestoque', $qtdestoque, PDO::PARAM_INT);
    $stmt->bindParam(':desc', $desc);
    $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: ../msg/msgSucesso.html');
    } else {
        header('Location: ../msg/msgErro.html');
    }
    exit;
?>