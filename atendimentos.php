<?php

$idatendimento = isset($_GET["idatendimento"]) ? $_GET["idatendimento"]: null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;

try {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdprojetofinal";
    $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 

    if($op=="del"){
        $sql = "delete  FROM atendimentos where idatendimento= :idatendimento";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idatendimento",$idatendimento);
        $stmt->execute();
        header("Location:listaratendimentos.php");
    }


    if($idatendimento){
        //estou buscando os dados do cliente no BD
        $sql = "SELECT * FROM  atendimentos where idatendimento= :idatendimento";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idatendimento",$idatendimento);
        $stmt->execute();
        $atendimento = $stmt->fetch(PDO::FETCH_OBJ);
        //var_dump($atendimento);
    }
    if($_POST){
        if($_POST["idatendimento"]){
            $sql = "UPDATE atendimentos SET cliente=:cliente, email=:email, msg=:msg WHERE idatendimento =:idatendimento";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":cliente", $_POST["cliente"]);
            $stmt->bindValue(":email", $_POST["email"]);
            $stmt->bindValue(":msg", $_POST["msg"]);
            $stmt->bindValue(":idatendimento", $_POST["idatendimento"]);
            $stmt->execute(); 
        } else {
            $sql = "INSERT INTO atendimentos (cliente,email,msg) VALUES (:cliente,:email,:msg)";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":cliente", $_POST["cliente"]);
            $stmt->bindValue(":email", $_POST["email"]);
            $stmt->bindValue(":msg", $_POST["msg"]);
            $stmt->execute(); 
        }
        header("Location:listaratendimentos.php");
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
    <title>Fale Conosco</title>
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
          <a class="nav-link" href="listaratendimentos.php">Lista de Atendimentos</a>
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
        <table class="table table-dark table-striped">
            <h1>Atendimentos</h1>
            <form method="POST">
            <div class="field">
                <label class="label">Cliente</label>
                <div class="control">
                    <input name="cliente" required class="input" type="text" value="<?php echo isset($atendimento) ? $atendimento->cliente : null ?>"><br>
                </div>
            </div>
            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input name="email" required class="input" type="email" value="<?php echo isset($atendimento) ? $atendimento->email : null ?>"><br>>
                </div>
            </div>
            <div class="field">
                <label class="label">Mensagem</label>
                <div class="control">
                    <textarea name="msg" required class="" type="textarea" maxlenght="2000" value="<?php echo isset($atendimento) ? $atendimento->msg : null ?>"></textarea>
                </div>
            </div>
            <input type="hidden" name="idatendimento"  required     value="<?php echo isset($atendimento) ? $atendimento->idatendimento : null ?>">
            <br>
            <input type="submit" class="btn btn-outline-dark">
        </table>
    </div>
</form>
</body>
</html>