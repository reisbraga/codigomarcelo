<?php
include('../config/database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $imagem = $_FILES['imagem']['name'];

    // Movimento do arquivo da imagem para a pasta de uploads
    $targetDir = "../assets/images/";
    $targetFile = $targetDir . basename($imagem);
    move_uploaded_file($_FILES['imagem']['tmp_name'], $targetFile);

    // Inserção no banco de dados
    $sql = "INSERT INTO produtos (nome, descricao, preco, imagem) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $descricao, $preco, $imagem]);

    echo "Produto adicionado com sucesso!";
}
?>

<form action="addProduto.php" method="POST" enctype="multipart/form-data">
    <label for="nome">Nome do Produto:</label>
    <input type="text" name="nome" required><br>

    <label for="descricao">Descrição:</label>
    <textarea name="descricao" required></textarea><br>

    <label for="preco">Preço:</label>
    <input type="text" name="preco" required><br>

    <label for="imagem">Imagem:</label>
    <input type="file" name="imagem" required><br>

    <button type="submit">Adicionar Produto</button>
</form>
