<?php
require_once '../init.php';

$Produto = isset($_POST['produto']) ? $_POST['produto'] : null;
$Compra = isset($_POST['idCompra']) ? $_POST['idCompra'] : null;
$Id = isset($_POST['idProduto_Compra']) ? $_POST['idProduto_Compra'] : null;

if (empty($Produto) || empty($Compra) || empty($Id)) {
    header('Location: ../msg/msgErro.html');
    exit;
}

$PDO = db_connect();
$sql = "INSERT INTO Produto_Compra (idProduto_Compra, Produto_idProduto, Compra_idCompra) VALUES (:Id, :Produto, :Compra)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
$stmt->bindParam(':Produto', $Produto);
$stmt->bindParam(':Compra', $Compra);

if ($stmt->execute()) {
    header('Location: ../msg/msgSucessoCompra.html');
} else {
    header('Location: ../msg/msgErro.html');
}
exit;
?>