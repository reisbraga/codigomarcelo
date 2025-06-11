<?php
    require '../init.php';

    $Id = isset($_GET['idProduto']) ? (int) $_GET['idProduto'] : null;

    if (empty($Id)) {
        header('Location: ../msg/msgErro.html');
    }

    $PDO = db_connect();
    $sqlProduto = "SELECT idProduto, NmProduto, PrecoProduto, QtdEstoqueProduto, DescProduto FROM Produto WHERE idProduto = :idProduto";
    $stmtProduto = $PDO->prepare($sqlProduto);
    $stmtProduto->bindParam(':idProduto', $Id, PDO::PARAM_INT);
    $stmtProduto->execute();
    $Produto = $stmtProduto->fetch(PDO::FETCH_ASSOC);

    if (!is_array($Produto)) {
        header('Location: ../msg/msgErro.html');
    }


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cachorro Bobo</title>
    <link rel="icon" href="../assets/logo_Bobo.png">
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="../bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#menu").load("../Navbar/navbar.html");
        });
    </script>
</head>
<body>
    <div id="menu"></div>

    <div class="container">
        <div class="jumbotron">
            <p class="h3 text-center">Editar Produto</p>
        </div>
    </div>

    <div class="container">
        <form action="editProduto.php" method="post">
        <div class="form-group">
                <label for="nomeproduto">Nome:</label>
                <input type="text" class="form-control" name="nomeproduto" id="nomeproduto" required placeholder="Informe o nome do produto" value="<?php echo $Produto['NmProduto']; ?>">
            </div>

            <div class="form-group">
                <label for="preco">Preço:</label>
                <input type="text" class="form-control" name="preco" id="preco" required placeholder="Informe o preço do produto" value="<?php echo $Produto['PrecoProduto']; ?>">
            </div>

            <div class="form-group">
                <label for="qtdestoque">Quantidade em Estoque:</label>
                <input type="number" class="form-control" name="qtdestoque" id="qtdestoque" required  placeholder="Informe a quantidade em estoque" value="<?php echo $Produto['QtdEstoqueProduto']; ?>">
            </div>
            
            <div class="form-group">
                <label for="desc">Descrição do Produto:</label>
                <input type="text" class="form-control" name="desc" id="desc" required  placeholder="Informe a Descrição do produto" value="<?php echo $Produto['DescProduto']; ?>">
            </div>
            <input type="hidden" name="Id" value="<?php echo $Id; ?>">
            <button type="submit" class="btn btn-primary">Enviar</button>
            <a class="btn btn-danger" href="../index.html">Cancelar</a>
        </form>
    </div>

    <footer class="text-muted">
    <div class="container">
      <p class="float-right"><a href="#">Voltar ao topo</a></p>
      <h3 style="color: white">&copy; Cachorro Bobo</h3>
    </div>
  </footer>
</body>
</html>