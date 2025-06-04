<?php
require_once '../init.php';

$nomeproduto = isset($_POST['nomeproduto']) ? $_POST['nomeproduto'] : null;
$preco = isset($_POST['preco']) ? $_POST['preco'] : null;
$qtdestoque = isset($_POST['qtdestoque']) ? $_POST['qtdestoque'] : null;
$desc = isset($_POST['desc']) ? $_POST['desc'] : null;

if (empty($nomeproduto) || empty($preco) || empty($qtdestoque) || empty($desc)) {
    header('Location: ../msg/msgErro.html');
}

$PDO = db_connect();
$sql = "INSERT INTO Produto (NmProduto, PrecoProduto, QtdEstoqueProduto, DescProduto) VALUES (:nomeproduto, :preco, :qtdestoque, :desc)";
$stmt = $PDO->prepare($sql);

$stmt->bindParam(':nomeproduto', $nomeproduto);
$stmt->bindParam(':preco', $preco);
$stmt->bindParam(':qtdestoque', $qtdestoque, PDO::PARAM_INT);
$stmt->bindParam(':desc', $desc);

if ($stmt->execute()) {
    header('Location: ../msg/msgSucesso.html');
} else {
    header('Location: ../msg/msgErro.html');
}
?>
