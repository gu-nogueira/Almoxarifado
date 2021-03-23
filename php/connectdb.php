<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'proj_almox';
// Tentativa de conexão com o banco de dados.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// Caso haja algum problema com a conexão, mostra o erro resultante.
	exit('Falha ao conectar ao MySQL: ' . mysqli_connect_error());
}
?>
