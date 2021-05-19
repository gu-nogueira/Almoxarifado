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
    <script src="../js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../js/jquery.mask.min.js" type="text/javascript"></script>
	</head>
	<body class="screen">
      <div class="container">
				<h1>Inserção de Requisição</h1>
        <br>
        <form action="" method="post">
        <label for="requisitante">Requisitante</label>
        <select name="requisitante"> 
          <option value=""> </option>
          <?php
            $query = $con->query("SELECT Nome FROM requisitante");
             while($reg = $query->fetch_array()) {          
                echo '<option value="'.$reg['Nome'].'">'.utf8_encode($reg['Nome']).'</option>';    
            }
          ?>
        </select>
        <br>
        <label for="data">Data Retirada</label>
        <input type="date" id="data" name="data" placeholder="Data">
        <br>
          <label for="produtos">Produtos</label>
          <label for="qtd" style="margin-left: 429px;">Quantidade</label>
          <br>
           
          <div class="container1">
          <select name="produtos[]" class="selecao_requisicao products">
            <option value=""> </option>
            <?php
              $sql = $con->query("SELECT Descricao FROM produto");
              while($valor = $sql->fetch_array()){
                echo '<option value="'.$valor["Descricao"].'">'.utf8_encode($valor["Descricao"]).'</option>';
              }
            ?>
          </select>
          <input type="text" name="qtd[]" id="qtd" placeholder="Qtd" class="selecao_requisicao quantity" required="required">
          <br>
          </div>

          <button class="increase"><i class="fas fa-plus"></i></button>
          <input class="button" type="submit" name="submit" value="Cadastrar">
        </form>
      </div>
	</body>

  <script type="text/javascript">

  $(document).ready(function() {
    var max_fields = 10;
    var wrapper = $(".container1");
    var add_button = $(".increase");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append('<div><select name="produtos[]" class="selecao_requisicao products"> <option value=""> </option> <?php $sql = $con->query("SELECT Descricao FROM produto"); while($valor = $sql->fetch_array()){ echo '<option value="'.$valor["Descricao"].'">'.utf8_encode($valor["Descricao"]).'</option>'; } ?> </select> <input type="text" name="qtd[]" id="qtd" placeholder="Qtd" class="selecao_requisicao quantity" required="required"> <a href="#" class="delete">&#10005</a><br></div>'); //add input box
        } else {
            alert('Somente é possível inserir 10 produtos em cada requisição.')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
        })
    });
    
  </script>

</html>

<?php
  if (isset($_POST['submit'])) {
    $requisitante = $_POST['requisitante'];

    $lucao  = mysqli_query($con, "SELECT idRequisitante FROM requisitante WHERE Nome = '$requisitante'");
    $id_requisitante = $lucao->fetch_row();

    $data = $_POST['data'];

    $sql = "INSERT INTO requisicao (Data_retirada, Requisitante_idRequisitante)
    VALUES ('$data', '$id_requisitante[0]')";

    if (mysqli_query($con, $sql)) {
      $produtos = $_POST['produtos'];
      $qtd = $_POST['qtd'];


    } else {
      echo "Erro ao cadastrar requisição: " . $sql . "<br>" . mysqli_error($con);
    }


    

    
 


    mysqli_close($con);
  }
?>