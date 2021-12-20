<?php

$idcompra = isset($_GET["idcompra"]) ? $_GET["idcompra"]: null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;

try {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdprojetofinal";
    $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 

    if($op=="del"){
        $sql = "delete  FROM compras where idcompra= :idcompra";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idcompra",$idcompra);
        $stmt->execute();
        header("Location:listarcompras.php");
    }


    if($idcompra){
        //estou buscando os dados do cliente no BD
        $sql = "SELECT * FROM  compras where idcompra= :idcompra";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idcompra",$idcompra);
        $stmt->execute();
        $compra = $stmt->fetch(PDO::FETCH_OBJ);
        //var_dump($cliente);
    }
    if($_POST){
        if($_POST["idcompra"]){
            $sql = "UPDATE compras SET compra=:compra, qnt=:qnt WHERE idcompra =:idcompra";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":compra", $_POST["compra"]);
            $stmt->bindValue(":qnt",$_POST["qnt"]);
            $stmt->bindValue(":idcompra", $_POST["idcompra"]);
            $stmt->execute(); 
        } else {
            $sql = "INSERT INTO compras(compra,qnt) VALUES (:compra,:qnt)";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":compra",$_POST["compra"]);
            $stmt->bindValue(":qnt",$_POST["qnt"]);
            $stmt->execute(); 
        }
        header("Location:listarcompras.php");
    } 
} catch(PDOException $e){
     echo "erro".$e->getMessage;
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Compras</title>
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
          <a class="nav-link" href="listarcompras.php">Lista de Compras</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="atendimentos.php">Atendimentos</a>
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
        <table class="table table-dark table-striped">
            <h1>Cadastro de Compras</h1>
            <form method="POST">
            <div class="field">
                <label class="label">Compra</label>
                <div class="control">
                    <input name="compra" required class="input" type="text" value="<?php echo isset($compra) ? $compra->compra : null ?>"><br>
                </div>
            </div>
            <div class="field">
                <label class="label">Quantidade</label>
                <div class="control">
                    <input name="qnt" required class="input" type="text" value="<?php echo isset($compra) ? $compra->qnt : null ?>"><br>
                </div>
            </div>
            <input type="hidden" name="idcompra"  required     value="<?php echo isset($compra) ? $compra->idcompra : null ?>">
            <br>
            <input type="submit" class="btn btn-outline-dark" value="Comprar">
            </form>
        </table>
    </div>
</body>
</html>