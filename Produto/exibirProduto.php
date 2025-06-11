<?php
require_once '../init.php';

$PDO = db_connect();
$sql = "SELECT P.idProduto, P.NmProduto, P.PrecoProduto, P.QtdEstoqueProduto, P.DescProduto 
        FROM Produto AS P";
$stmt = $PDO->prepare($sql);
$stmt->execute();
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
    <div class="jumbotron bg-dark-blue">
            <p class="h3 text-center">Produtos cadastrados</p>
        </div>
    </div>

    <div class="container">
    <div class="jumbotron bg-dark-blue">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="color: #f8bfff">Nome</th>
                    <th scope="col" style="color: #f8bfff">Preço</th>
                    <th scope="col" style="color: #f8bfff">Quantidade em Estoque</th>
                    <th scope="col" style="color: #f8bfff">Descrição</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>

                    <td><?php echo ($dados['NmProduto']); ?></td>
                    <td><?php echo $dados['PrecoProduto']; ?></td>
                    <td><?php echo ($dados['QtdEstoqueProduto']); ?></td>
                    <td><?php echo ($dados['DescProduto']); ?></td>
                    <td>
                        <a class="btn btn-info" href="formEditProduto.php?idProduto=<?php echo $dados['idProduto']; ?>">Editar</a>
                        <a class="btn btn-danger" href="deleteProduto.php?idProduto=<?php echo $dados['idProduto']; ?>" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
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