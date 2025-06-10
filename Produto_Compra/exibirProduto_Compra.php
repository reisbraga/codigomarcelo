<?php
    require_once '../init.php';

    $Id = isset($_GET['Id']) ? $_GET['Id'] : null;

    $PDO = db_connect();
    $sql = "SELECT P.idProduto, P.NmProduto, P.PrecoProduto, P.DescProduto, Pc.Id, C.idCompra, Pc.Produto_idProduto
            FROM Produto AS P
            INNER JOIN Produto_Compra AS Pc ON P.idProduto = Pc.Produto_idProduto
            INNER JOIN Compra AS C ON Pe.Compra_idCompra = C.idCompra
            WHERE C.idCompra = $Id
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
    <title>Jardineira</title>
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
            <p class="h3 text-center">Pedidos cadastrados</p>
        </div>
    </div>

    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <th scope="row"><?php echo $dados['IdProduto']; ?></th>
                    <td><?php echo $dados['Nome']; ?></td>
                    <td><?php echo $dados['Valor']; ?></td>
                    <td><?php echo $dados['Tipo']; ?></td>                    
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        
            <a class="btn btn-secondary" href="../compras/exibirCompras.php">Voltar</a>
        
    </div>



    <div class="container">
        <div class="card-footer">
            <p class="h6 text-center">Todos os direitos reservados &copy; Copyright</p>
        </div>
    </div>
</body>
</html>