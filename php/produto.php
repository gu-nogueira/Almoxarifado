<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.html');
	exit;
}

include ('connectdb.php');

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
        <label for="user">Descrição</label>
        <input type="text" id="desc" name="desc" placeholder="Descrição">
        <br>
        <label for="password">Local Armazenado</label>
        <input type="text" id="local" name="local" placeholder="Local Armazenado">
        <br>
        <label for="contact">Quantidade em estoque</label>
        <input type="text" id="qtd" name="qtd" placeholder="Estoque">
        <br>
        <label for="contact">Categoria</label>
        <select name="cat"> 
          <option value=""> </option>
          <?php
             $query = $con->query("SELECT Descricao FROM categoria");
             while($reg = $query->fetch_array()) {
                echo '<option value="'.$reg["Descricao"].'">'.$reg["Descricao"].'</option>';    
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

    include('connectdb.php');

    $sql = "INSERT INTO produto (Descricao, Local_armaz, Qtde_estoque, Categoria_idCategoria)
    VALUES ('$desc', '$local', '$qtd', '$cat_final')";

    if (mysqli_query($con, $sql)) {
      echo "Ta cadastrado meu cria, beijocas!";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
  }
?>