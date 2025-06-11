<?php
require_once '../init.php';

$PDO = db_connect();
$sql = "SELECT C.idCompra, C.DtCompra, U.NmUsuario 
        FROM Compra AS C 
        INNER JOIN Usuario AS U ON C.Usuario_idUsuario = U.idUsuario
        ORDER BY C.idCompra DESC";
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
            <p class="h3 text-center">Compras Realizadas</p>
        </div>
    </div>

    <div class="container">
    <div class="jumbotron bg-dark-blue">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="color: #f8bfff">ID</th>
                    <th scope="col" style="color: #f8bfff">Data da Compra</th>
                    <th scope="col" style="color: #f8bfff">Cliente</th>
                    <th scope="col" style="color: #f8bfff">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <th scope="row"><?php echo $dados['idCompra']; ?></th>
                    <td><input type="date" readonly value="<?php echo $dados['DtCompra']; ?>"></td>
                    <td><?php echo $dados['NmUsuario']; ?></td>
                    <td>
                        <a class="btn btn-primary" href="../Produto_Compra/formAddProduto_Compra.php?idCompra=<?php echo $dados['idCompra']; ?>">Adicionar Produtos</a>
                        <a class="btn btn-secondary" href="../Produto_Compra/exibirProduto_Compra.php?idCompra=<?php echo $dados['idCompra']; ?>">Ver Produtos</a>
                        <a class="btn btn-danger" href="../Compra/deleteCompra.php?idCompra=<?php echo $dados['idCompra']; ?>" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a>
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