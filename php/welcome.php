<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.html');
	exit;
}

include('connectdb.php');

$sql = $con->query("SELECT COUNT(*) AS idRequisicao FROM requisicao;");
$requisicao = $sql->fetch_assoc();

$sql = $con->query("SELECT COUNT(*) AS idRequisita FROM requisita;");
$estoque = $sql->fetch_assoc();

$sql = $con->query("SELECT COUNT(*) AS idProduto FROM produto;");
$produto = $sql->fetch_assoc();

$sql = $con->query("SELECT COUNT(*) AS idFornecedor FROM fornecedor;");
$fornecedor = $sql->fetch_assoc();

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
				<p> Seja bem vindo, <?=$_SESSION['name']?>! </p>
        <section class="dashboard">
					<h1>Resumo geral:</h1>
					<div class="row">
						<div class="card pink" onclick="window.location = './relatorios/rel_requisicao.php';">
							Requisições <br><br>
							<text> <?= $requisicao['idRequisicao']; ?></text>
						</div>
						<div class="card green" onclick="window.location = './relatorios/rel_requisicao.php';">
							Baixas em estoque <br><br>
							<text> <?= $estoque['idRequisita']; ?> </text>
						</div>
						<div class="card yellow" onclick="window.location = './relatorios/rel_produto.php';">
							Produtos <br><br>
							<text> <?= $produto['idProduto']; ?> </text>
						</div>
						<div class="card blue" onclick="window.location = './relatorios/rel_fornecedor.php';">
							Fornecedores <br><br>
							<text> <?= $fornecedor['idFornecedor']; ?> </text>
						</div>
					</div>
				</section>
	</body>
</html>