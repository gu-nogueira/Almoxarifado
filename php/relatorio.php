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
	<body class="box">

      <h1>Emissão de Relátórios</h1>
      <br>

      <form action="">

      <table>      
        <tr> 
          <td> <input type="submit" name="fornecedor" value="Fornecedores"></td>
          <td> <input type="submit" name="produto" value="Produtos"></td>
        </tr>
        <tr>  
          <td> <input type="submit" name="categoria" value="Categorias"> </td>
          <td> <input type="submit" name="requisicao" value="Requisições"> </td>
        </tr>
      </table>  

    </form>

	</body>
</html>
