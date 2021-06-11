<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.html');
	exit;
}
include('connectdb.php');
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
				<h1>Cadastro de produto</h1>
        <br>
        <form action="" method="post">
        <label for="desc">Descrição</label>
        <input type="text" id="desc" name="desc" placeholder="Descrição">
        <br>
        <label for="local">Local Armazenado</label>
        <input type="text" id="local" name="local" placeholder="Local Armazenado">
        <br>
        <label for="qtd">Quantidade em estoque</label>
        <input type="text" id="qtd" name="qtd" placeholder="Estoque">
        <br>
        <label for="cat">Categoria</label>
        <select name="cat"> 
          <option value=""> </option>
          <?php          
             $query = $con->query("SELECT Descricao_categoria FROM categoria");
             while($reg = $query->fetch_array()) {
                echo '<option value="'.$reg["Descricao_categoria"].'">'.utf8_encode($reg["Descricao_categoria"]).'</option>';    
             }
          ?>
        </select>
        <br>
        <input class="button" type="submit" name="submit" value="Cadastrar">
        </form>
      </div>
	</body>
</html>

<?php
  if (isset($_POST['submit'])) {
    $desc = $_POST['desc'];
    $local = $_POST['local'];
    $qtd = $_POST['qtd'];
    $cat = $_POST['cat'];

    

    $lucao  = mysqli_query($con, "SELECT idCategoria FROM Categoria WHERE Descricao_categoria = '$cat'");
    $cat_final = $lucao->fetch_row();

    $sql = "INSERT INTO produto (Descricao, Local_armaz, Qtde_estoque, Categoria_idCategoria)
    VALUES ('$desc', '$local', '$qtd', '$cat_final[0]')";


    if (mysqli_query($con, $sql)) {
      echo "Produto cadastrado com sucesso!";
    } else {
      echo "Erro ao cadastrar produto: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
  }
?>