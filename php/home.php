<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.html');
	exit;
}
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
	<body class="loggedin">

    <!-- Cabeçalho -->
		<nav class="navtop">
    <button class="sidemenu-button" onclick="openmenu()">☰</button>
			<div>
        <div><a href="home.php"><h1>Controle de Almoxarifado</h1></a></div>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Perfil</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>

  <!-- Sidebar -->
  <div class="sidemenu" style="display:none" id="sidebar">
    <button onclick="closemenu()" class="sidemenu-itens sidemenu-close">Fechar &times;</button>
    <a href="fornecedor.php" target="iframe_1" class="sidemenu-itens">Fornecedores</a>
    <a href="produto.php" target="iframe_1" class="sidemenu-itens">Produtos</a>
    <a href="requisicao.php" target="iframe_1" class="sidemenu-itens">Requisições</a>
    <a href="requisitante.php" target="iframe_1" class="sidemenu-itens"> Requisitante </a>
    <a href="categoria.php" target="iframe_1" class="sidemenu-itens"> Categoria </a>
    <a href="users.php" target="iframe_1" class="sidemenu-itens">Usuários</a>
    <button class="dropdown-btn">Relatórios
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-container">
			<a href="relatorios/rel_fornecedor.php" target="iframe_1" class="sidemenu-itens">Fornecedores</a>
			<a href="relatorios/rel_produto.php" target="iframe_1" class="sidemenu-itens">Produtos</a>
			<a href="relatorios/rel_categoria.php" target="iframe_1" class="sidemenu-itens">Categorias</a>
			<a href="relatorios/rel_requisicao.php"" target="iframe_1" class="sidemenu-itens">Requisições</a>
		</div>
  </div>

		<div class="content">
			<h2>Início</h2>
			<div class="card">
				<iframe src="welcome.php" name="iframe_1" width="1150px" height="500px" frameborder="0px">  </iframe>	
			</div>
		</div>

    <script>

		// Movimento do menu lateral
    function openmenu() {
      document.getElementById("sidebar").style.display = "flex";
    } 
    function closemenu() {
      document.getElementById("sidebar").style.display = "none";
    }

		// Dropdown

		var dropdown = document.getElementsByClassName("dropdown-btn");
		var i;

		for (i = 0; i < dropdown.length; i++) {
			dropdown[i].addEventListener("click", function() {
				this.classList.toggle("active");
				var dropdownContent = this.nextElementSibling;
				if (dropdownContent.style.display === "flex") {
					dropdownContent.style.display = "none";
				} else {
					dropdownContent.style.display = "flex";
					
				}
			});
		}

    </script>

	</body>
</html>