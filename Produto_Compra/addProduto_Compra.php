<?php
require_once '../init.php';

$Produto = isset($_POST['produto']) ? $_POST['produto'] : null;
$Compra = isset($_POST['idCompra']) ? $_POST['idCompra'] : null;

if (empty($Produto) || empty($Compra)) {
    header('Location: ../msg/msgErro.html');
    exit;
}

$PDO = db_connect();
$sql = "INSERT INTO Produto_Compra (Produto_idProduto, Compra_idCompra) VALUES (:Produto, :Compra)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':Produto', $Produto);
$stmt->bindParam(':Compra', $Compra);

if ($stmt->execute()) {
    header('Location: ../msg/msgSucessoCompra.html');
} else {
    header('Location: ../msg/msgErro.html');
}
exit;
?>