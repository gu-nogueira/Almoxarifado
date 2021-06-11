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
	<body class="box">

      <h1>Emissão de Relátórios</h1>
      <br>

      <form action="">

      <table>      
        <tr> 
          <td> <button name="fornecedor"> Fornecedores </button> </td>
          <td> <button name="produto" value="Produtos"> Produtos </button> </td>
        </tr>
        <tr>  
          <td> <button name="categoria"> Categorias </button> </td>
          <td> <button name="requisicao"> Requisições </button> </td>
        </tr>
      </table>  

    </form>

	</body>
</html>
