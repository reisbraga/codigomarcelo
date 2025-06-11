<?php
require_once '../init.php';

$PDO = db_connect();
$sql = "SELECT idUsuario, NmUsuario FROM Usuario ORDER BY NmUsuario ASC";
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
            <p class="h3 text-center">Comprar Produtos</p>
        </div>
    </div>

    <div class="container">
        <form action="addCompra.php" method="post">
            <div class="form-group">
                <label for="data">Data da compra:</label>
                <input type="date" class="form-control" name="data" id="data">
            </div>

            <div class="form-group">
                <label for="usuario">Selecione o cliente</label>
                <select class="form-control" name="usuario" id="usuario" required>
                    <?php while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?php echo $dados['idUsuario']; ?>"><?php echo $dados['NmUsuario']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

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