<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: ../../index.html');
	exit;
}

include('../connectdb.php');
$id = filter_input(INPUT_GET, 'id');
$sql = "SELECT * FROM fornecedor WHERE idFornecedor = '$id'";
$result = $con->query($sql);
$data = $result->fetch_assoc();

if (isset($_POST['submit'])) {
  $nome_fantasia = $_POST['Nome_fantasia'];
  $cidade = $_POST['Cidade'];
  $endereco = $_POST['Endereco'];
  $contato = $_POST['Contato'];
  $cnpj = $_POST['CNPJ'];
  include('../connectdb.php');
  $sql = "UPDATE fornecedor SET Nome_fantasia='$nome_fantasia', Cidade='$cidade', Endereco='$endereco', Contato='$contato', CNPJ='$cnpj' WHERE idFornecedor='$id'";
  
  if (mysqli_query($con, $sql)) {
    ?><script>
      alert("Atualização realizada com sucesso!");
      location.replace("rel_fornecedor.php");
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
  <script src="../../js/jquery.mask.min.js" type="text/javascript"></script>
</head>

<body class="screen">
      <div class="container">
				<h1>Atualização de fornecedor: <?=$data['Nome_fantasia']?></h1>
        <br>
        <form action="" method="post">
          <label for="user">Nome Fantasia</label> 
          <input type="text" name="Nome_fantasia" placeholder="Nome Fantasia" value="<?=$data['Nome_fantasia']?>">
          <br>
          <label for="password">Cidade</label>
          <input type="text" name="Cidade" placeholder="Cidade" value="<?=$data['Cidade']?>">
          <br>
          <label for="contact">Endereço</label>
          <input type="text" name="Endereco" placeholder="Endereço" value="<?=$data['Endereco']?>">
          <br>
          <label for="contact">Contato</label>
          <input type="text" name="Contato" placeholder="Contato" value="<?=$data['Contato']?>">
          <br>
          <label for="contact">CNPJ</label>
          <input type="text" id="cnpj" name="CNPJ" value="<?= $data['CNPJ'] ?>">
          <br>
          <input class="button" type="submit" name="submit" value="Atualizar">
        </form>
      </div>

	</body>

  <script type="text/javascript">
    $(document).ready(function () {
      $('#cnpj').mask("00.000.000/0000-00", { placeholder: '00.000.000/0000-00' });
    });
  </script>

</html>