<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../../index.html');
	exit;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Controle de Almoxarifado</title>
		<link href="../../css/reset.css" rel="stylesheet" type="text/css">
		<link href="../../css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body class="box">
      <h1>Relatório de Fornecedores</h1>
      <br>

      

	</body>
</html>
