<?php
    require_once '../init.php';

    $Id = isset($_POST['Id']) ? $_POST['Id'] : null;
    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $endereco = isset($_POST['endereco']) ? $_POST['endereco'] : null;
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;

    if (empty($Id) || empty($nome) || empty($endereco) || empty($telefone) || empty($email)) {
        header('Location: ../msg/msgErro.html');
        exit;
    }

    $PDO = db_connect();
    $sql = "UPDATE Usuario SET NmUsuario = :nome, Endereco = :endereco, FoneUsuario = :telefone, EmailUsuario = :email WHERE idUsuario = :Id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: ../msg/msgSucesso.html');
    } else {
        header('Location: ../msg/msgErro.html');
    }
    exit;
?>