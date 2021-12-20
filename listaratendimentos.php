<?php
include('conexao.php');

try{
    $sql = "SELECT * from atendimentos";
    $qry = $con->query($sql);
    $atendimentos = $qry->fetchAll(PDO::FETCH_OBJ);
    //echo "<pre>";
    //print_r($atendimentos);
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
    <title>Listar Atendimentos</title>
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
        <h1>Lista de Atendimentos</h1>
        <br>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                <th>id</th> 
                <th>Cliente</th>
                <th>Email</th>
                <th>Mensagem</th>
                <th colspan=2>Ações</th>
                
                </tr>
            </thead>
            <tbody>
                <?php foreach($atendimentos as $a) { ?>
                <tr>
                    <td><?php echo $a->idatendimento ?></td>
                    <td><?php echo $a->cliente ?></td>
                    <td><?php echo $a->email ?></td>
                    <td><?php echo $a->msg ?></td>
                    <td><a href="atendimentos.php?idatendimento=<?php echo $a->idatendimento ?>" class="btn btn-outline-warning">Editar</a></td>
                    <td><a href="atendimentos.php?op=del&idatendimento=<?php echo  $a->idatendimento ?>" class="btn btn-outline-danger">Excluir</a></td>

                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>