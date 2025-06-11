<?php
    require_once '../init.php';

    $idCompra = isset($_GET['idCompra']) ? $_GET['idCompra'] : null;

    $PDO = db_connect();
    $sql = "SELECT P.idProduto, P.NmProduto, P.PrecoProduto, P.DescProduto, PC.idProduto_Compra, C.idCompra, PC.Produto_idProduto
            FROM Produto AS P
            INNER JOIN Produto_Compra AS PC ON P.idProduto = PC.Produto_idProduto
            INNER JOIN Compra AS C ON PC.Compra_idCompra = C.idCompra
            WHERE C.idCompra = $idCompra
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
    <link rel="icon" href="assets/logo_Bobo.png">
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
                    <th scope="col">Id Produto</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Descrição</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <th scope="row"><?php echo $dados['idProduto']; ?></th>
                    <td><?php echo $dados['NmProduto']; ?></td>
                    <td><?php echo $dados['PrecoProduto']; ?></td>
                    <td><?php echo $dados['DescProduto']; ?></td> 
                    <td>
                        <a class="btn btn-danger" href="deleteProduto_Compra.php?Produto_idProduto=<?php echo $dados['Produto_idProduto']; ?>" 
                        onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a>
                    </td>      
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>



    <div class="container">
        <div class="card-footer">
            <p class="h6 text-center">Todos os direitos reservados &copy; Copyright</p>
        </div>
    </div>
</body>
</html>