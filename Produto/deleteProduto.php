<?php
include('../config/database.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca o produto pelo id
    $sql = "SELECT * FROM produtos WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $produto = $stmt->fetch();

    // Deleta o produto do banco de dados
    $sql = "DELETE FROM produtos WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    // Deleta a imagem do produto, se existir
    if ($produto['imagem']) {
        unlink('../assets/images/' . $produto['imagem']);
    }

    echo "Produto excluído com sucesso!";
}
?>
