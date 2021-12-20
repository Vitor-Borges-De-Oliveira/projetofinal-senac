<?php
include('conexao.php');

try{
    $sql = "SELECT * from compras";
    $qry = $con->query($sql);
    $compras = $qry->fetchAll(PDO::FETCH_OBJ);
    //echo "<pre>";
    //print_r($compras);
    //die();
} catch(PDOException $e){
    echo $e->getMessage();

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">KaBuM</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="atendimentos.php">Atendimentos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="compras.php">Compras</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registros.php">Registros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.html">Home</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<hr>
    <div class="container">
        <h1>Lista de Compras</h1><br>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                <th>id</th> 
                <th>Compra</th>
                <th>Quantidade</th>
                <th colspan=2>Ações</th>
                
                </tr>
            </thead>
            <tbody>
                <?php foreach($compras as $c) { ?>
                <tr>
                    <td><?php echo $c->idcompra ?></td>
                    <td><?php echo $c->compra ?></td>
                    <td><?php echo $c->qnt ?></td>
                    <td><a href="compras.php?idcompra=<?php echo $c->idcompra ?>" class="btn btn-outline-warning">Editar</a></td>
                    <td><a href="compras.php?op=del&idcompra=<?php echo  $c->idcompra ?>" class="btn btn-outline-danger">Excluir</a></td>

                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>