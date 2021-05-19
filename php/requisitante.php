<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
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
				<h1>Cadastro de requisitante</h1>
        <br>
        <form action="" method="post">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" placeholder="Nome">
        <br>
        <label for="setor">Setor</label>
        <input type="text" id="setor" name="setor" placeholder="Setor">
        <br>
        <input class="button" type="submit" name="submit" value="Cadastrar">
        </form>
      </div>
	</body>
</html>

<?php
  if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $setor = $_POST['setor'];

    include('connectdb.php');

    $sql = "INSERT INTO requisitante  (Nome, Setor) VALUES ('$nome', '$setor')";

    if (mysqli_query($con, $sql)) {
      echo "Requisitante cadastrado com sucesso!";
    } else {
      echo "Erro ao cadastrar requisitante: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
  }
?>