<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.html');
	exit;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Controle de Almoxarifado</title>
		<link href="../css/reset.css" rel="stylesheet" type="text/css">
		<link href="../css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="screen">
      <div class="container">
				<h1>Cadastro de Categoria</h1>
        <br>
        <form action="" method="post">
        <label for="user">Descrição</label>
        <input type="text" id="desc" name="desc" placeholder="Descrição">
        <br>
        <input class="button" type="submit" name="submit" value="Cadastrar">
        </form>
      </div>
	</body>
</html>

<?php
  if (isset($_POST['submit'])) {
    $desc = $_POST['desc'];

    include('connectdb.php');

    $sql = "INSERT INTO categoria (Descricao_categoria)
    VALUES ('$desc')";

    if (mysqli_query($con, $sql)) {
      echo "Categoria cadastrada com sucesso!";
    } else {
      echo "Erro ao cadastrar categoria: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
  }
?>