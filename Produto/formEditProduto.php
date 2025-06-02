<?php
include('../config/database.php');

if (!isset($_GET['id'])) {
    echo "ID do produto não fornecido.";
    exit;
}

$id = $_GET['id'];

// Busca o produto no banco
$sql = "SELECT * FROM produtos WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$produto = $stmt->fetch();

if (!$produto) {
    echo "Produto não encontrado.";
    exit;
}
?>

<h2>Editar Produto</h2>

<form action="editProduto.php?id=<?php echo $produto['id']; ?>" method="POST" enctype="multipart/form-data">
    <label for="nome">Nome:</label><br>
    <input type="text" name="nome" value="<?php echo htmlspecialchars($produto['nome']); ?>" required><br><br>

    <label for="descricao">Descrição:</label><br>
    <textarea name="descricao" required><?php echo htmlspecialchars($produto['descricao']); ?></textarea><br><br>

    <label for="preco">Preço:</label><br>
    <input type="text" name="preco" value="<?php echo number_format($produto['preco'], 2, '.', ''); ?>" required><br><br>

    <label for="imagem">Imagem atual:</label><br>
    <?php if ($produto['imagem']): ?>
        <img src="../assets/images/<?php echo $produto['imagem']; ?>" width="150"><br>
    <?php endif; ?>
    <label for="imagem">Trocar imagem:</label><br>
    <input type="file" name="imagem"><br><br>

    <button type="submit">Salvar Alterações</button>
</form>
