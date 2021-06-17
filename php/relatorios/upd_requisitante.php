<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: ../../index.html');
	exit;
}

include('../connectdb.php');
$id = filter_input(INPUT_GET, 'id');
$sql = "SELECT * FROM requisitante WHERE idRequisitante = '$id'";
$result = $con->query($sql);
$data = $result->fetch_assoc();

// Envio dos dados

if (isset($_POST['submit'])) {
  $nome = $_POST['Nome'];
  $setor = $_POST['Setor'];
  include('../connectdb.php');
  $sql = "UPDATE requisitante SET Nome='$nome', Setor='$setor' WHERE idRequisitante='$id'";
  
  if (mysqli_query($con, $sql)) {
    ?><script>
      alert("Atualização realizada com sucesso!");
      location.replace("rel_requisitante.php");
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
				<h1>Atualização de requisitante: <?=$data['Nome']?></h1>
        <br>
        <form action="" method="post">
          <label for="user">Nome</label> 
          <input type="text" name="Nome" value="<?=$data['Nome']?>">
          <br>
          <label for="password">Setor</label>
          <input type="text" name="Setor" value="<?=$data['Setor']?>">
          <br>
          <input class="button" type="submit" name="submit" value="Atualizar">
        </form>
      </div>

	</body>

</html>