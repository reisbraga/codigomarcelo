<?php
    require '../init.php';

    $Id = isset($_GET['idUsuario']) ? (int) $_GET['idUsuario'] : null;

    if (empty($Id)) {
        header('Location: ../msg/msgErro.html');
    }

    $PDO = db_connect();
    $sqlUsuario = "SELECT idUsuario, NmUsuario, Endereco, FoneUsuario, EmailUsuario FROM Usuario WHERE idUsuario = :idUsuario";
    $stmtUsuario = $PDO->prepare($sqlUsuario);
    $stmtUsuario->bindParam(':idUsuario', $Id, PDO::PARAM_INT);
    $stmtUsuario->execute();
    $Usuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);

    if (!is_array($Usuario)) {
        header('Location: ../msg/msgErro.html');
    }


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
            <p class="h3 text-center">Editar Produto</p>
        </div>
    </div>

    <div class="container">
        <form action="editUsuario.php" method="post">
        <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" name="nome" id="nome" required minlength="5" placeholder="Informe o seu nome" value="<?php echo $Usuario['NmUsuario']; ?>">
            </div>

            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <input type="text" class="form-control" name="endereco" id="endereco" required minlength="5" placeholder="Informe o seu endereço" value="<?php echo $Usuario['Endereco']; ?>">
            </div>

            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" class="form-control" name="telefone" id="telefone" required minlength="5" placeholder="Informe o seu telefone" value="<?php echo $Usuario['FoneUsuario']; ?>">
            </div>
            
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="text" class="form-control" name="email" id="email" required minlength="5" placeholder="Informe o seu E-mail" value="<?php echo $Usuario['EmailUsuario']; ?>">
            </div>
            <input type="hidden" name="Id" value="<?php echo $Id; ?>">
            <button type="submit" class="btn btn-primary">Enviar</button>
            <a class="btn btn-danger" href="../index.html">Cancelar</a>
        </form>
    </div>

    <div class="container">
        <div class="card-footer">
            <p class="h6 text-center">Todos os direitos reservados &copy; Copyright</p>
        </div>
    </div>
</body>
</html>