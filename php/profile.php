<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.html');
	exit;
}
include('connectdb.php');
$stmt = $con->prepare('SELECT Senha, Contato FROM usuarios WHERE idUsuarios = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($Senha, $Contato);
$stmt->fetch();
$stmt->close();
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
<body>
  <div class="box">
    <div class="data-box" style="margin: 0; align-items: center; justify-content: space-between;">
      <h1 style=>Perfil de usuário</h1>
    </div>
    <section style="border-bottom: 1px solid #e0e0e3; padding-top: 20px;"></section>
    <br>
    <div class="data-content">
      <div class="data-box">
        <section class="data-row">
          <b class="data-header">Nome</b>
          <b class="data-header">Contato</b>
        </section>
        <section class="data-row" id="data">
          <p class="data-item"><?= $_SESSION['name']?></p>
          <p class="data-item"><?= $Contato ?></p>
        </section>
      </div>
      <div class="data-box">
        <a class="data-edit" href="./relatorios/upd_users.php?id=<?=$_SESSION['id']?>"><i class="fas fa-pencil-alt"></i></a>
      </div>
		</div>
  </div>
</body>
</html>