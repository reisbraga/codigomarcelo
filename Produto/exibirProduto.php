<?php
include('../config/database.php');

$sql = "SELECT * FROM produtos";
$stmt = $pdo->query($sql);
$produtos = $stmt->fetchAll();

foreach ($produtos as $produto) {
    echo "<div>";
    echo "<h3>" . $produto['nome'] . "</h3>";
    echo "<p>" . $produto['descricao'] . "</p>";
    echo "<p>Preço: R$ " . number_format($produto['preco'], 2, ',', '.') . "</p>";
    echo "<img src='../assets/images/" . $produto['imagem'] . "' alt='" . $produto['nome'] . "' width='150'><br>";
    echo "<a href='editProduto.php?id=" . $produto['id'] . "'>Editar</a> | ";
    echo "<a href='deleteProduto.php?id=" . $produto['id'] . "'>Excluir</a>";
    echo "</div><hr>";
}
?>
