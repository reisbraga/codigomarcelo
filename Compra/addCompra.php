<?php
require_once '../init.php';

$data = isset($_POST['data']) ? $_POST['data'] : null;
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null;

if (empty($data) || empty($usuario)) {
    header('Location: ../msg/msgErro.html');
    exit;
}

$PDO = db_connect();
$sql = "INSERT INTO Compra (DtCompra, Usuario_idUsuario) VALUES (:data, :usuario)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':data', $data);
$stmt->bindParam(':usuario', $usuario);

if ($stmt->execute()) {
    header('Location: ../msg/msgSucessoCompra.html');
} else {
    header('Location: ../msg/msgErro.html');
}
exit;
?>