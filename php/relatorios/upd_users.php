<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: ../../index.html');
	exit;
}

include('../connectdb.php');
$id = filter_input(INPUT_GET, 'id');
$sql = "SELECT * FROM usuarios WHERE idUsuarios = '$id'";
$result = $con->query($sql);
$data = $result->fetch_assoc();

// Envio dos dados

if (isset($_POST['submit'])) {
  $user = $_POST['user'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $contact = $_POST['contact'];
  include('../connectdb.php');
  $sql = "UPDATE usuarios SET Usuario='$user', Senha='$password', Contato='$contact' WHERE idUsuarios='$id'";
  
  if (mysqli_query($con, $sql)) {
    ?><script>
      alert("Atualização realizada com sucesso!");
      location.replace("rel_users.php");
    </script><?php
  } else {
    echo "Erro ao executar a query: " . $sql . "<br>" . mysqli_error($con);
  }
mysqli_close($con);
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Controle de Almoxarifado</title>
  <link href="../../css/reset.css" rel="stylesheet" type="text/css">
  <link href="../../css/style.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <script src="../../js/jquery-3.6.0.min.js" type="text/javascript"></script>
</head>

<body class="screen">
  
      <div class="container">
				<h1>Atualização de usuário: <?=$data['Usuario']?></h1>
        <br>
        <form action="" method="post">
          <label for="user">Usuario</label> 
          <input type="text" name="user" value="<?=$data['Usuario']?>">
          <br>
          <label for="password">Senha</label>
          <input type="password" id="password" name="password" placeholder="Nova senha">
          <br>
          <label for="contact">Contato</label>
          <input type="text" id="contact" name="contact" value="<?=$data['Contato']?>">
          <br>
          <input class="button" type="submit" name="submit" value="Atualizar">
        </form>
      </div>

	</body>

</html>