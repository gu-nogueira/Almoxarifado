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
      <h1>Relatório de Produtos</h1>
      <section style="border-bottom: 1px solid #e0e0e3; padding-top: 20px;"></section>
      <br>
      <div>
        
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

          $postagem = $con->query("SELECT * FROM `produto` ORDER BY idProduto DESC LIMIT $limite OFFSET $offset");       

          while($info = $postagem->fetch_assoc()){
          // Loop finito para repetir para cada linha existente
          ?>
          
          <table>
            <tr> 
              <td width="20%"> <b> Descrição: </b> </td>
              <td> <i> <?= $info['Descricao'] ?> </i> </td>
            </tr>
            <tr> 
              <td width="20%"> <b> Estoque: </b> </td>
              <td> <i> <?= $info['Qtde_estoque'] ?> </i> </td>
            </tr>
            <tr> 
              <td width="20%"> <b> Local Armazenado: </b> </td>
              <td> <i> <?= $info['Local_armaz'] ?> </i> </td>
            </tr>
            <tr> <td> <br> </td> </tr>
            <tr> 
              <td width="20%"> 
                <a class="data-edit" href="#"><i class="fas fa-pencil-alt"></i></a>
                <a class="data-delete" href="#"><i class="fas fa-trash"></i></a>
                <a class="data-print" onclick="window.print()"><i class="fas fa-print"></i></a>
              </td>
            </tr>
          </table>
          <br>
          <hr>

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
