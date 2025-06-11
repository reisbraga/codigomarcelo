<?php
require_once '../init.php';

$PDO = db_connect();
$sql = "SELECT U.idUsuario, U.NmUsuario, U.Endereco, U.FoneUsuario, U.EmailUsuario 
        FROM Usuario AS U";
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
            <p class="h3 text-center">Produtos cadastrados</p>
        </div>
    </div>

    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">E-mail</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>

                    <td><?php echo ($dados['NmUsuario']); ?></td>
                    <td><?php echo $dados['Endereco']; ?></td>
                    <td><?php echo ($dados['FoneUsuario']); ?></td>
                    <td><?php echo ($dados['EmailUsuario']); ?></td>
                    <td>
                        <a class="btn btn-info" href="formEditUsuario.php?idUsuario=<?php echo $dados['idUsuario']; ?>">Editar</a>
                        <a class="btn btn-danger" href="deleteUsuario.php?idUsuario=<?php echo $dados['idUsuario']; ?>" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a>
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