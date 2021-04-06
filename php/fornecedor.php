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
          <input type="text" id="cnpj" name="cnpj" placeholder="CNPJ">
          <br>
          <input class="button" type="submit" name="submit" value="Cadastrar">
        </form>
      </div>

	</body>

      <script src="../js/jquery.mask.min.js" type="text/javascript"> </script>
      <script src="../js/jquery-min.js" type="text/javascript"> </script>
      <script type="text/javascript">
          
        $(document).ready(function(){
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

    /* //Função máscara de CPF e CNPJ
    function mask($val, $mask){
    $maskared = '';
    $k = 0;

    for($i = 0; $i<=strlen($mark)-1; $i++){
      if($mask[$i] == '#'){
        if(isset($val[$k])) $maskared .= $val[$k++];
      } else {
        if(isset($mask[$i])) $maskared .= $mask[$i];
      }
    }
    return $maskared;
  }

  $cpf = mask($details["cpf"], '###.###.###-##');
  $cnpj = mask($details["cnpj"], '##.###.###/####-##'); */

    include('connectdb.php');

    $sql = "INSERT INTO fornecedor (Nome_fantasia, Endereco, Cidade, Contato, CNPJ)
    VALUES ('$nome', '$end', '$cidade', '$contact', '$cnpj')";

    if (mysqli_query($con, $sql)) {
      echo "Ta cadastrado meu cria, beijocas!";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
  }
?>