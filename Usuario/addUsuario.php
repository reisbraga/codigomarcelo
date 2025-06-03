<?php
require_once '../scripts/init.php';

$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$endereco = isset($_POST['endereco']) ? $_POST['endereco'] : null;
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;

if (empty($nome) || empty($endereco) || empty($telefone) || empty($email)) {
    header('Location: ../msg/msgErro.html');
}

$PDO = db_connect();
$sql = "INSERT INTO livro (nome, endereco, telefone, email) VALUES (:nome, :endereco, :telefone, :email)";
$stmt = $PDO->prepare($sql);

$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':endereco', $autor);
$stmt->bindParam(':telefone', $telefone);
$stmt->bindParam(':email', $email);

if ($stmt->execute()) {
    header('Location: ../msg/msgSucesso.html');
} else {
    header('Location: ../msg/msgErro.html');
}
?>
