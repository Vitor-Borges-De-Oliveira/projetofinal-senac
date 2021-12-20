<?php

$idregistro = isset($_GET["idregistro"]) ? $_GET["idregistro"]: null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;

try {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdprojetofinal";
    $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 

    if($op=="del"){
        $sql = "delete  FROM registros where idregistro= :idregistro";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idregistro",$idregistro);
        $stmt->execute();
        header("Location:listarregistros.php");
    }


    if($idregistro){
        //estou buscando os dados do cliente no BD
        $sql = "SELECT * FROM  registros where idregistro= :idregistro";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idregistro",$idregistro);
        $stmt->execute();
        $registro = $stmt->fetch(PDO::FETCH_OBJ);
        //var_dump($registro);
    }
    if($_POST){
        if($_POST["idregistro"]){
            $sql = "UPDATE registros SET nome=:nome, email=:email, senha=:senha WHERE idregistro =:idregistro";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":nome", $_POST["nome"]);
            $stmt->bindValue(":email", $_POST["email"]);
            $stmt->bindValue(":senha", $_POST["senha"]);
            $stmt->bindValue(":idregistro", $_POST["idregistro"]);
            $stmt->execute(); 
        } else {
            $sql = "INSERT INTO registros (nome,email,senha) VALUES (:nome,:email,:senha)";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":nome", $_POST["nome"]);
            $stmt->bindValue(":email", $_POST["email"]);
            $stmt->bindValue(":senha", $_POST["senha"]);
            $stmt->execute(); 
        }
        header("Location:listarregistros.php");
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
    <title>Registros</title>
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
          <a class="nav-link" href="listarregistros.php">Lista de Registros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="atendimentos.php">Atendimentos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="compras.php">Compras</a>
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
            <h1>Registros</h1><br>
            <form method="POST">
            Nome                     <input type="text"       name="nome"        required     value="<?php echo isset($registro) ? $registro->nome : null ?>"><br>
            Email                    <input type="email"      name="email"       required     value="<?php echo isset($registro) ? $registro->email : null ?>"><br>
            Senha                    <input type="text"       name="senha"       required     value="<?php echo isset($registro) ? $registro->senha : null ?>"><br>
            <input type="hidden"                              name="idregistro"  required     value="<?php echo isset($registro) ? $registro->idregistro : null ?>">
            <br>
            <input type="submit" class="btn btn-outline-dark">
            </form>
        </table>
    </div>
</body>
</html>