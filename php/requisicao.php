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
        <form id="requestForm">
          <label for="requisitante">Requisitante</label>
          <select id="requisitante" name="requisitante" required="true"> 
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
          <input type="date" id="data" name="data" required="true">
          <br>
          <label for="produtos">Produtos</label>
          <label for="qtd_estoque" style="margin-left: 430px; width: 145px;">Estoque</label>
          <label for="qtd">Quantidade</label>
          <br>  
          <div class="container1">
            <select name="produtos[]" id="produtos" class="selecao_requisicao products" onchange="getAmount(event)" required="true">
              <option value=""> </option>
              <?php
                $sql = $con->query("SELECT idProduto, Descricao, Qtde_estoque FROM produto");
                while($valor = $sql->fetch_array()){
                  echo '<option value="'.$valor["idProduto"].'" id="'.$valor["Qtde_estoque"].'">'.utf8_encode($valor["Descricao"]).'</option>';
                }
              ?>
            </select>
            <input type="text" id="qtd_estoque" placeholder="Estoque" class="selecao_requisicao quantity" style="padding: 12px;" disabled>
            <input type="text" id="qtd" placeholder="Quantidade" class="selecao_requisicao quantity" required="true">

          </div>

          <button class="increase"><i class="fas fa-plus"></i></button>
          <input class="button" type="submit" name="submit" value="Cadastrar">
        </form>
      </div>
    <!-- MODAL DE EXCLUSÃO -->
    <div id="modal" class="modal-container">
      <div class="modal" style="width: 60%;">
        <button class="modal-close">×</button>
        <h1>Confirmar baixa de estoque</h1>
        <div id="content">
        </div>
        <form action="" method="post">
          <input style="margin-top: 30px;"type="button" value="Dar baixa em estoque" class="data-delete" id="delete-action" onclick="$.fn.deleteAction();">
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
          $(wrapper).append('<div><select name="produtos[]" id="produtos" class="selecao_requisicao products" onchange="getAmount(event)" required="true"> <option value=""> </option> <?php $sql = $con->query("SELECT idProduto, Descricao, Qtde_estoque FROM produto"); while($valor = $sql->fetch_array()){ echo '<option value="'.$valor["idProduto"].'" id="'.$valor["Qtde_estoque"].'">'.utf8_encode($valor["Descricao"]).'</option>'; } ?> </select><input type="number" id="qtd_estoque" placeholder="Estoque" class="selecao_requisicao quantity" style="margin-left: 5px !important;" disabled> <input type="text" id="qtd" placeholder="Quantidade" class="selecao_requisicao quantity" required="true"> <a href="#" class="delete">&#10005</a></div>'); //add input box
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

// Pega a timezone correta do usuário

Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});

// Insere no input date o dia de hoje

document.getElementById('data').value = new Date().toDateInputValue();

// Verifica se foi enviado o HTTP POST  

$('#requestForm').submit(function(e){
    e.preventDefault();

    getData();
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
  requisicao.id_produtos = [];
  requisicao.qtd_produtos = [];
  for(i = produtos.length; i--; requisicao.produtos.unshift(produtos[i]));
  for(i = produtos.length; i--; requisicao.qtd_produtos.unshift(qtd[i])); 

  for(i=0;i<produtos.length;i++) {
    requisicao.id_produtos.push(requisicao.produtos[i].selectedOptions[0].value);
    requisicao.produtos[i] = requisicao.produtos[i].selectedOptions[0].innerHTML;
    requisicao.qtd_produtos[i] = requisicao.qtd_produtos[i].value;
  }

  if (hasDuplicates(requisicao.produtos)) {
    window.alert("Atenção! Produtos duplicados!");
  } else {
    startModal('modal');
  }
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

// Função para verificar se há duplicatas no array de produtos

function hasDuplicates(array) {
    return (new Set(array)).size !== array.length;
}

// Código para funcionamento do modal

function startModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.add('modal-show');
    let content = document.getElementById("content");
    let deleteButton = document.getElementById("delete-action");
    let verify = [];
    let result = `<br>Requisitante: ${requisicao.requisitante}<br>`
    result += `Data da requisição: ${requisicao.data_retirada}<br>`
    result += `<table style="width: 100%;"><tr style="border-top: 5px red"><td><b>Produto:</b></td><td><b>Estoque:</b></td><td><b>Quantia requisitada:</b></td></td><td><b>Estoque atualizado:</b></td></tr>`;
    for (i = 0 ; i < requisicao.produtos.length ; i++) {
      result += `<tr><td>${requisicao.produtos[i]}</td><td>${requisicao.estoque[i]}</td><td>${requisicao.qtd_produtos[i]}</td>`;
      if (parseInt(requisicao.estoque[i]) >= parseInt(requisicao.qtd_produtos[i])) {
        result += `<td style="color: green;">${requisicao.estoque[i] - requisicao.qtd_produtos[i]}</td></tr>`;
        verify.push(true);
      } else {
        result += `<td style="color: red";> ${requisicao.estoque[i] - requisicao.qtd_produtos[i]}</d></tr>`
        verify.push(false);
      }
    }

    result += `</table>`

    if (verify.includes(false)) {
      result += `<br><text style="color: red";> <b>Atenção:</b> Não há produtos em estoque o suficiente! </text>`;
      deleteButton.disabled = true;
      deleteButton.style.backgroundColor = "grey";
    } else {
      deleteButton.disabled = false;
      deleteButton.style.backgroundColor = "crimson";
    }

    content.innerHTML += result;

    modal.addEventListener('click', (e) => {
      if (e.target.id == modalId || e.target.className == 'modal-close') {
        modal.classList.remove('modal-show');

        content.innerHTML = '';
        verify = [];
      }
    });
  }
}


// ajax

$.fn.deleteAction = function() {
  // Laço para dar baixa no estoque
  for (let i = 0 ; i < requisicao.produtos.length ; i++) {
    requisicao.estoque[i] = parseInt(requisicao.estoque[i]) - parseInt(requisicao.qtd_produtos[i]);
  }
  console.log(requisicao);
  $.ajax({
    type: 'POST',
    url: 'upd_estoque.php',
    data: {
      requisicao: requisicao
    },
    dataType: "json",
    success: function(response) {
      console.log(response);
      if (response) {
        window.alert("Requisição cadastrada com sucesso!");
        location.reload();
      }
    }
  });
}

</script>

</html>