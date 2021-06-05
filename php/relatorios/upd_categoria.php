<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: ../../index.html');
	exit;
}

include('../connectdb.php');
$id = filter_input(INPUT_GET, 'id');
$sql = "SELECT * FROM categoria WHERE idCategoria = '$id'";
$result = $con->query($sql);
$data = $result->fetch_assoc();

if (isset($_POST['submit'])) {
  $descricao = $_POST['Descricao_categoria'];
  $sql = "UPDATE `categoria` SET Descricao_categoria='$descricao' WHERE idCategoria='$id'";
  
  if (mysqli_query($con, $sql)) {
    ?><script>
      alert("Atualização realizada com sucesso!");
      location.replace("rel_categoria.php");
    </script><?php
  } else {
    echo "Erro ao executar a query: " . $sql . "<br>" . mysqli_error($con);
  }
mysqli_close($con);
}
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
				<h1>Atualização de categoria: <?=utf8_encode($data['Descricao_categoria'])?></h1>
        <br>
        <form action="" method="post">
          <label for="Descricao_categoria">Descrição</label> 
          <input type="text" name="Descricao_categoria" value="<?=utf8_encode($data['Descricao_categoria'])?>">
          <br>
          <br>
          <input class="button" type="submit" name="submit" value="Atualizar">
        </form>
      </div>
	</body>
</html>