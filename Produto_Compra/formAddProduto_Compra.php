<?php
require '../init.php';

$id = isset($_GET['idCompra']) ? (int) $_GET['idCompra'] : null;

if (empty($id)) {
    header('Location: ../msg/msgErro.html');
    exit;
}

$PDO = db_connect();
$sqlProduto = "SELECT idProduto, NmProduto FROM Produto ORDER BY NmProduto ASC";
$stmtProduto = $PDO->prepare($sqlProduto);
$stmtProduto->execute();
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
        <div class="jumbotron  bg-dark-blue">
            <p class="h3 text-center">Produtos das compras</p>
        </div>
    </div>

    <div class="container">
    <div class="jumbotron bg-dark-blue">
        <form action="addProduto_Compra.php" method="post">
            <div class="form-group">
                <label for="produto">Selecione o produto</label>
                <select class="form-control" name="produto" id="produto" required>
                    <?php while ($dados = $stmtProduto->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?php echo $dados['idProduto']; ?>"><?php echo $dados['NmProduto']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <input type="hidden" name="idCompra" value="<?php echo $id; ?>">
            <input type="hidden" name="idProduto_Compra" value="<?php echo $idProduto_Compra; ?>">
            <button type="submit" class="btn btn-primary">Enviar</button>
            <a class="btn btn-danger" href="../index.html">Cancelar</a>
        </form>
    </div>
                    </div>

    <footer class="text-muted">
    <div class="container">
      <p class="float-right"><a href="#">Voltar ao topo</a></p>
      <h3 style="color: white">&copy; Cachorro Bobo</h3>
    </div>
  </footer>
  <style>
        .bg-dark-blue {
          background-color: #873ba5;
        }
      </style>
</body>
</html>