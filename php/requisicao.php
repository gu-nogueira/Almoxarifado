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
	</head>
	<body class="screen">
      <div class="container">
				<h1>Inserção de Requisição</h1>
        <br>
        <p style="color: red;">Atenção! após cadastrada, a requisição dará baixa em estoque.</p>
        <br>

        <label for="requisitante">Requisitante</label>
        <select id="requisitante" name="requisitante"> 
          <option value=""> </option>
          <?php
            $query = $con->query("SELECT idRequisitante, Nome FROM requisitante");
             while($reg = $query->fetch_array()) {         
                echo '<option value="'.$reg['idRequisitante'].'" id="teste">'.utf8_encode($reg['Nome']).'</option>';    
            } 
          ?>
        </select>
        <br>
        <label for="data">Data Retirada</label>
        <input type="date" id="data" name="data" placeholder="Data">
        <br>
          <label for="produtos">Produtos</label>
          <label for="qtd" style="margin-left: 430px; width: 145px;">Estoque</label>
          <label for="qtd">Quantidade</label>
          <br>
           
          <div class="container1">
            <select name="produtos[]" id="produtos" class="selecao_requisicao products" onchange="getAmount(event)">
              <option value=""> </option>
              <?php
                $sql = $con->query("SELECT idProduto, Descricao, Qtde_estoque FROM produto");
                while($valor = $sql->fetch_array()){
                  echo '<option value="'.$valor["idProduto"].'" id="'.$valor["Qtde_estoque"].'">'.utf8_encode($valor["Descricao"]).'</option>';
                }
              ?>
            </select>
            <input type="text" id="qtd_estoque" placeholder="Estoque" class="selecao_requisicao quantity" disabled>
            <input type="text" id="qtd" placeholder="Quantidade" class="selecao_requisicao quantity" required="required">

          </div>

          <button class="increase"><i class="fas fa-plus"></i></button>
          <input class="button" type="submit" name="submit" onclick="getData();" value="Cadastrar">

      </div>
    <!-- MODAL DE EXCLUSÃO -->
    <div id="modal" class="modal-container">
      <div class="modal">
        <button class="modal-close">×</button>
        <h1>Baixa de estoque</h1>
        <div id="content">
        </div>
        <form action="" method="post">
          <input style="margin-top: 30px;"type="button" value="Dar baixa em estoque" class="data-delete" name="delete-action" onclick="$.fn.deleteAction();">
        </form>
      </div>
    </div>
	</body>

<script type="text/javascript">

let requisicao = {};

$(document).ready(function() {
  var max_fields = 10;
  var wrapper = $(".container1");
  var add_button = $(".increase");

  var x = 1;
  $(add_button).click(function(e) {
      e.preventDefault();
      if (x < max_fields) {
          x++;
          $(wrapper).append('<div><select name="produtos[]" id="produtos" class="selecao_requisicao products" onchange="getAmount(event)"> <option value=""> </option> <?php $sql = $con->query("SELECT idProduto, Descricao, Qtde_estoque FROM produto"); while($valor = $sql->fetch_array()){ echo '<option value="'.$valor["idProduto"].'" id="'.$valor["Qtde_estoque"].'">'.utf8_encode($valor["Descricao"]).'</option>'; } ?> </select><input type="number" id="qtd_estoque" placeholder="Estoque" class="selecao_requisicao quantity" style="margin-left: 5px !important;" disabled> <input type="text" id="qtd" placeholder="Quantidade" class="selecao_requisicao quantity" required="required"> <a href="#" class="delete">&#10005</a></div>'); //add input box
      } else {
          alert('Somente é possível inserir 10 produtos em cada requisição.')
      }
  });

  // Insere e remove inputs

  $(wrapper).on("click", ".delete", function(e) {
    e.preventDefault();
    $(this).parent('div').remove();
    x--;
    })
});

// Código para pegar os campos

function getData() {

  requisicao.id_requisitante = document.getElementById("requisitante").selectedOptions[0].value;
  requisicao.requisitante = document.getElementById("requisitante").selectedOptions[0].innerHTML;
  requisicao.data_retirada = document.getElementById("data").value;
  let produtos = document.querySelectorAll("#produtos");
  let qtd = document.querySelectorAll("#qtd");
  let i = 0;

  requisicao.produtos = [];
  requisicao.qtd_produtos = [];
  for(i = produtos.length; i--; requisicao.produtos.unshift(produtos[i]));
  for(i = produtos.length; i--; requisicao.qtd_produtos.unshift(qtd[i])); 

  for(i=0;i<produtos.length;i++) {
    requisicao.produtos[i] = requisicao.produtos[i].selectedOptions[0].innerHTML;
    requisicao.qtd_produtos[i] = requisicao.qtd_produtos[i].value;
  }

  startModal('modal');
}

// Código para pegar estoque do produto
requisicao.estoque = [];

function getAmount(e) {
  let estoque = [];
  let produtos = document.querySelectorAll("#produtos");
  for(i = produtos.length; i--; estoque.unshift(produtos[i]));
  for(i=0;i<estoque.length;i++) {
    estoque[i] = estoque[i].selectedOptions[0].id;
    let qtd = document.querySelectorAll("#qtd_estoque");
    qtd[i].value = estoque[i];
    requisicao.estoque[i] = estoque[i];
  }
}

// Código para funcionamento do modal

function startModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.add('modal-show')
    let content = document.getElementById("content");
    let result = `<br>Requisitante: ${requisicao.requisitante}<br>`
    result += `Data da requisição: ${requisicao.data_retirada}<br>`

    for (i = 0 ; i < requisicao.produtos.length ; i++) {
      result += `Produtos: ${requisicao.produtos[i]}<br>`
      result += `Estoque: ${requisicao.estoque[i]}<br>`
      result += `Quantidade requisitada: ${requisicao.qtd_produtos[i]}<br>`
      if (requisicao.estoque[i] > requisicao.qtd_produtos[i]) {
        result += `<text style="border: 'none'; color: green">Estoque atualizado: </text>${requisicao.estoque[i] - requisicao.qtd_produtos[i]}<br>`
      } else {
        result += `<text style="border: 'none'; color: red"> Quantida em estoque insuficiente: </text> ${requisicao.estoque[i] - requisicao.qtd_produtos[i]}<br>`
      }
    }

    content.innerHTML += result;


    modal.addEventListener('click', (e) => {
      if (e.target.id == modalId || e.target.className == 'modal-close') {
        modal.classList.remove('modal-show');
      }
    });
  }
}


// ajax

$.fn.deleteAction = function() {
  $.ajax({
    type: 'POST',
    url: 'upd_estoque.php',
    data: {
      req_id: reqId
    },
    dataType: "json",
    success: function(response) {
      console.log(response);
      if (response) {
        location.reload();
      }
    }
  });
}

</script>

</html>

<!-- php para inserir os dados no banco -->

<?php
  // if (isset($_POST['submit'])) {
  //   $requisitante = $_POST['requisitante'];
  //   $data = $_POST['data'];
  //   $produtos = $_POST['produtos'];
  //   $qtd = $_POST['qtd'];

  //   $sql = "INSERT INTO requisicao (Data_retirada, Requisitante_idRequisitante)
  //   VALUES ('$data', '$requisitante')";

  //   if (mysqli_query($con, $sql)) {

  //     $id_requisicao = mysqli_insert_id($con);
  //     $quant = count($produtos);

  //     for($i=0;$i<$quant;$i++){
  //       mysqli_query($con, "INSERT INTO requisita (Produto_idProduto, Qtde_requisita,	Requisicao_idRequisicao)
  //       VALUES ('$produtos[$i]', '$qtd[$i]', '$id_requisicao')");
  //     }
  //   } else {
  //     echo "Erro ao cadastrar requisição: " . $sql . "<br>" . mysqli_error($con);
  //   }
    
  //   mysqli_close($con);
  // }
?>