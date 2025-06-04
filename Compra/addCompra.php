<?php
require_once '../scripts/init.php';

$DataHora = isset($_POST['DataHora']) ? $_POST['DataHora'] : null;
$Usuario = isset($_POST['Usuario']) ? $_POST['Usuario'] : null;

if (empty($DataHora) || empty($Usuario)) {
    header('Location: ../msg/msgErro.html');
    exit;
}

$PDO = db_connect();
$sql = "INSERT INTO Compra (DataHora, IdUsuario) VALUES (:DataHora, :Usuario)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':DataHora', $DataHora);
$stmt->bindParam(':Usuario', $Usuario);

if ($stmt->execute()) {
    header('Location: ../msg/msgSucessoCompra.html');
} else {
    header('Location: ../msg/msgErro.html');
}
exit;
?>