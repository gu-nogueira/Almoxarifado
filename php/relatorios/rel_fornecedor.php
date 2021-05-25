<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
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
	</head>
	<body class="box">
      <h1>Relatório de Fornecedores</h1>
      <section style="border-bottom: 1px solid #e0e0e3; padding-top: 20px;"></section>
      <br>
      <div class="data-content">
        <section class="data-row">
          <b class="data-header">Nome Fantasia</b>
          <b class="data-header">Cidade</b>
          <b class="data-header">Endereço</b>
          <b class="data-header">Contato</b>
          <b class="data-header">CNPJ</b>
          <div style="width: 83px;"></div>
        </section>

        <?php
          include('../connectdb.php');

          $limite = 15; // Limite por página

          // Pega página atual, se houver e for válido (maior que zero!)
          if( isset( $_GET['pagina'] ) && (int)$_GET['pagina'] >= 0){
              $pagina = (int)$_GET['pagina'];
          }else{
              $pagina = 0;
          }

          // Calcula o offset
          $offset = $limite * $pagina;

          // Se for 0 será 15*0 que será 0, começando do inicio
          // Se for 1 será 15*1 que irá começar do 15 ignorando os 15 anteriores. ;)

          $postagem = $con->query("SELECT * FROM `fornecedor` ORDER BY idFornecedor DESC LIMIT $limite OFFSET $offset");       

          while($info = $postagem->fetch_assoc()){
          // Loop finito para repetir para cada linha existente
          ?>

          <section class="data-row">
            <p class="data-item"><?= $info['Nome_fantasia'] ?></p>
            <p class="data-item"><?= $info['Cidade'] ?></p>
            <p class="data-item"><?= $info['Endereco'] ?></p>
            <p class="data-item"><?= $info['Contato'] ?></p>
            <p class="data-item"><?= $info['CNPJ'] ?></p>
            <a class="data-edit" href="#"><i class="fas fa-pencil-alt"></i></a>
            <a class="data-delete" href="#"><i class="fas fa-trash"></i></a>
          </section>

          <?php
          }
          
          if($pagina !== 0){ // Sem isto irá exibir "Página Anterior" na primeira página.
            ?>
            <a href="meulink.com?pagina=<?php echo $pagina-1; ?>">Página Anterior</a>
            <?php
            }
            ?>
            <a href="meulink.com?pagina=<?php echo $pagina+1; ?>">Página Posterior</a>
            <?=
          $con->close();
        ?>

      </div>
	</body>
</html>
