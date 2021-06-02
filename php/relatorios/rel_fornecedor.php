<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: ../../index.html');
	exit;
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

<body>
  <div class="box">
    <div class="data-box" style="margin: 0; align-items: center; justify-content: space-between;">
      <h1 style=>Relatório de Fornecedores</h1>
      <a class="data-print" onclick="window.print()">Imprimir <i class="fas fa-print" style="margin-left: 7px;"></i></a>
    </div>
    <section style="border-bottom: 1px solid #e0e0e3; padding-top: 20px;"></section>
    <br>

    <div class="data-content">

      <?php
          include('../connectdb.php');

          $limite = 4;
          if( isset( $_GET['pagina'] ) && (int)$_GET['pagina'] >= 0){
              $pagina = (int)$_GET['pagina'];
          }else{
              $pagina = 0;
          }
          $offset = $limite * $pagina;
          $postagem = $con->query("SELECT * FROM `fornecedor` ORDER BY idFornecedor DESC LIMIT $limite OFFSET $offset");   

          $counter = 0;
          
          while($info = $postagem->fetch_assoc()){
          ?>
      <div class="data-box">
        <section class="data-row">
          <b class="data-header">Nome Fantasia</b>
          <b class="data-header">Cidade</b>
          <b class="data-header">Endereço</b>
          <b class="data-header">Contato</b>
          <b class="data-header">CNPJ</b>
        </section>

        <section class="data-row" id="data">
          <p class="data-item"><?= $info['Nome_fantasia'] ?></p>
          <p class="data-item"><?= $info['Cidade'] ?></p>
          <p class="data-item"><?= $info['Endereco'] ?></p>
          <p class="data-item"><?= $info['Contato'] ?></p>
          <p class="data-item"><?= $info['CNPJ'] ?></p>
        </section>
      </div>
      <div class="data-box">
        <a class="data-edit" href="upd_fornecedor.php?id=<?=$info['idFornecedor']?>"><i class="fas fa-pencil-alt"></i></a>
        <a class="data-delete" href="#" onclick="startModal('modal-delete'); fornecId = <?=$info['idFornecedor']?>;"><i class="fas fa-trash"></i></a>
      </div>

      <section style="border-bottom: 1px solid #e0e0e3; margin-bottom: 20px;"></section>
      <?php
      $counter++;
          }

          ?>
      <div class="pages" id="pages">
        <?php
          if($pagina !== 0){ 
            ?>
        <a href="?pagina=<?= $pagina-1; ?>">🡄</a>
        <?php
            }
            ?>
            <p>Página <?= $pagina+1; ?> </p>
            <?php
          if($counter == $limite){
            ?>
        <a href="?pagina=<?= $pagina+1; ?>">🡆</a>
        <?php
          }
          $con->close();
        ?>
      </div>
    </div>
  </div>

  <!-- MODAL DE EXCLUSÃO -->

  <div id="modal-delete" class="modal-container">
    <div class="modal">
      <button class="modal-close">×</button>
      <h1>Aviso</h1>
      <br>
      <p>Esta ação é irreversível, deseja continuar?</p>
      <br>
      <form action="" method="post">
        <input type="button" value="Deletar" class="data-delete" name="delete-action" onclick="$.fn.deleteAction();">
      </form>
    </div>
  </div>

  <script type="text/javascript">

  // Código para envio do delete

  let fornecId;

  $.fn.deleteAction = function() {
      $.ajax({
        type: 'POST',
        url: 'del_fornecedor.php',
        data: {fornec_id: fornecId},
        dataType: "json",
        success: function(response) {
          console.log(response);
          if (response) {
            location.reload();
          }
        }
      });
  }

  // Código para correção da estilização de paginação

  let counter = document.querySelectorAll('section#data').length;

  if (counter === 1) {
    document.getElementById('pages').style.marginTop = "6.5em";
    document.body.style.overflow = "hidden";
  }
  
  // Código para funcionamento do modal

  function startModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.classList.add('modal-show') // Lista todas as classes CSS e adiciona a classe modal-show. 
      modal.addEventListener('click', (e) => { // Passa como parâmetro 'e' o evento que foi clicado.
        if (e.target.id == modalId || e.target.className == 'modal-close') {
          modal.classList.remove('modal-show'); // Lista as classes CSS e remove a classe modal-show
        }
      });
    }
  }

  </script>

</body>

</html>