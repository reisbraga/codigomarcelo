<?php
include('../config/database.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca o produto pelo id
    $sql = "SELECT * FROM produtos WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $produto = $stmt->fetch();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $imagem = $_FILES['imagem']['name'];

        // Se uma nova imagem foi carregada, faça o upload
        if ($imagem) {
            $targetDir = "../assets/images/";
            $targetFile = $targetDir . basename($imagem);
            move_uploaded_file($_FILES['imagem']['tmp_name'], $targetFile);
        } else {
            $imagem = $produto['imagem'];  // Mantém a imagem anterior
        }

        // Atualiza no banco de dados
        $sql = "UPDATE produtos SET nome = ?, descricao = ?, preco = ?, imagem = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $descricao, $preco, $imagem, $id]);

        echo "Produto atualizado com sucesso!";
    }
}
?>

<form action="editProduto.php?id=<?php echo $produto['id']; ?>" method="POST" enctype="multipart/form-data">
    <label for="nome">Nome do Produto:</label>
    <input type="text" name="nome" value="<?php echo $produto['nome']; ?>" required><br>

    <label for="descricao">Descrição:</label>
    <textarea name="descricao" required><?php echo $produto['descricao']; ?></textarea><br>

    <label for="preco">Preço:</label>
    <input type="text" name="preco" value="<?php echo $produto['preco']; ?>" required><br>

    <label for="imagem">Imagem:</label>
    <input type="file" name="imagem"><br>

    <button type="submit">Editar Produto</button>
</form>
