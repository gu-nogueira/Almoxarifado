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
				<h1>Cadastro de usuário</h1>
        <br>
        <form action="" method="post">
        <label for="user">Usuário</label>
        <input type="text" id="user" name="user" placeholder="Usuário">
        <br>
        <label for="password">Senha</label>
        <input type="password" id="password" name="password" placeholder="Senha">
        <br>
        <label for="contact">Contato</label>
        <input type="text" id="contact" name="contact" placeholder="Contato">
        <br>
        <input class="button" type="submit" name="submit" value="Cadastrar">
        </form>
      </div>
	</body>
</html>

<?php
  if (isset($_POST['submit'])) {
    $user = $_POST['user'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $contact = $_POST['contact'];

    include('connectdb.php');

    $sql = "INSERT INTO usuarios (Usuario, Senha, Contato)
    VALUES ('$user', '$password', '$contact')";

    if (mysqli_query($con, $sql)) {
      echo "Usuário cadastrado com sucesso!";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
  }
?>