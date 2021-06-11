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
    <script src="../js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../js/jquery.mask.min.js" type="text/javascript"></script>
	</head>
	<body class="screen">
      <div class="container">
				<h1>Cadastro de Fornecedor</h1>
        <br>
        <form action="" method="post">
          <label for="user">Nome Fantasia</label> 
          <input type="text" id="nome" name="nome" placeholder="Nome Fantasia">
          <br>
          <label for="password">Cidade</label>
          <input type="text" id="cidade" name="cidade" placeholder="Cidade">
          <br>
          <label for="contact">Endereço</label>
          <input type="text" id="end" name="end" placeholder="Endereço">
          <br>
          <label for="contact">Contato</label>
          <input type="text" id="contact" name="contact" placeholder="Contato">
          <br>
          <label for="contact">CNPJ</label>
          <input type="text" id="cnpj" name="cnpj">
          <br>
          <input class="button" type="submit" name="submit" value="Cadastrar">
        </form>
      </div>

	</body> 

      <script type="text/javascript">
          
        $(document).ready(function () {
          $('#cnpj').mask("00.000.000/0000-00", { placeholder: '00.000.000/0000-00' });
        });

      </script>

</html>

<?php

  if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $cidade = $_POST['cidade'];
    $end = $_POST['end'];
    $contact = $_POST['contact'];
    $cnpj = $_POST['cnpj'];

    include('connectdb.php');

    $sql = "INSERT INTO fornecedor (Nome_fantasia, Endereco, Cidade, Contato, CNPJ)
    VALUES ('$nome', '$end', '$cidade', '$contact', '$cnpj')";

    if (mysqli_query($con, $sql)) {
      echo "Fornecedor cadastrado com sucesso!";
    } else {
      echo "Erro ao realizar cadastro: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
  }
?>