<!-- Este arquivo seria uma versão separada do formulário de adicionar produto -->
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
