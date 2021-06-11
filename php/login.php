<?php
session_start();
include('connectdb.php');


if ( !isset($_POST['Usuario'], $_POST['Senha']) ) {

	?>
    <script type="text/javascript">
    window.location.replace("../index.html");
    alert("Preencha os campos de login e senha!");
    </script>
  <?php
}


if ($stmt = $con->prepare('SELECT idUsuarios, Senha FROM usuarios WHERE Usuario = ?')) {

	$stmt->bind_param('s', $_POST['Usuario']);
	$stmt->execute();

	$stmt->store_result();

  if ($stmt->num_rows > 0) {
    $stmt->bind_result($idUsuarios, $Senha);
    $stmt->fetch();

    if (password_verify($_POST['Senha'], $Senha)) {
      session_regenerate_id();
      $_SESSION['loggedin'] = TRUE;
      $_SESSION['name'] = $_POST['Usuario'];
      $_SESSION['id'] = $idUsuarios;
      header('Location: home.php');
    } else {
      // Senha incorreta
      ?>
      <script type="text/javascript">
      window.location.replace("../index.html");
      alert("Usuário ou senha incorreta!");
      </script>
      <?php
    }
  } else {
    // Usuário incorreto
    ?>
    <script type="text/javascript">
    window.location.replace("../index.html");
    alert("Usuário ou senha incorreta!");
    </script>
    <?php
  }

	$stmt->close();
}
?>