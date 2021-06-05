<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: ../../index.html');
	exit;
}

include('../connectdb.php');
$id = filter_input(INPUT_GET, 'id');
$sql = "SELECT produto.idProduto, produto.Descricao, produto.Qtde_estoque, produto.Local_armaz, produto.Categoria_idCategoria, categoria.Descricao_categoria FROM `produto` INNER JOIN categoria ON produto.Categoria_idCategoria = categoria.idCategoria WHERE idProduto = '$id'";
;
$result = $con->query($sql);
$data = $result->fetch_assoc();

if (isset($_POST['submit'])) {
  $descricao = $_POST['Descricao'];
  $qtde_estoque = $_POST['Qtde_estoque'];
  $local_armaz = $_POST['Local_armaz'];
  $idCategoria = $_POST['idCategoria'];
  include('../connectdb.php');
  $sql = "UPDATE `produto` SET produto.Descricao='$descricao', produto.Qtde_estoque='$qtde_estoque', produto.Local_armaz='$local_armaz', produto.Categoria_idCategoria='$idCategoria' WHERE idProduto='$id'";
  
  if (mysqli_query($con, $sql)) {
    ?><script>
      alert("Atualização realizada com sucesso!");
      location.replace("rel_produto.php");
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
				<h1>Atualização de produto: <?=$data['Descricao']?></h1>
        <br>
        <form action="" method="post">
          <label for="Descricao">Descrição</label> 
          <input type="text" name="Descricao" value="<?=$data['Descricao']?>">
          <br>
          <label for="Qtde_estoque">Quantidade em estoque</label>
          <input type="text" name="Qtde_estoque" value="<?=$data['Qtde_estoque']?>">
          <br>
          <label for="Local_armaz">Local de armazenamento</label>
          <input type="text" name="Local_armaz" value="<?=$data['Local_armaz']?>">
          <br>
          <label for="idCategoria">Categoria</label>
          <select name="idCategoria" value="teste"> 
            <option value="<?=$data['Categoria_idCategoria']?>"> <?=utf8_encode($data['Descricao_categoria'])?> </option>
            <?php          
              $categoria = $data['Categoria_idCategoria'];
              $query = $con->query("SELECT * FROM categoria WHERE idCategoria != '$categoria'");
              while($reg = $query->fetch_array()) {
                  echo '<option value="'.$reg["idCategoria"].'">'.utf8_encode($reg["Descricao_categoria"]).'</option>';
              }
            ?>
          </select>
          <br>
          <input class="button" type="submit" name="submit" value="Atualizar">
        </form>
      </div>
	</body>
</html>