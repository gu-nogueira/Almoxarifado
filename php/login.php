<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'proj_almox';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Falha ao conectar ao MySQL: ' . mysqli_connect_error());
}

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['Usuario'], $_POST['Senha']) ) {
	// Could not get the data that should have been sent.
	exit('Preencha os campos de login e senha!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT idUsuarios, Senha FROM usuarios WHERE Usuario = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['Usuario']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

  if ($stmt->num_rows > 0) {
    $stmt->bind_result($idUsuarios, $Senha);
    $stmt->fetch();
    // Account exists, now we verify the password.
    // Note: remember to use password_hash in your registration file to store the hashed passwords.
    if (password_verify($_POST['Senha'], $Senha)) {
      // Verification success! User has logged-in!
      // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
      session_regenerate_id();
      $_SESSION['loggedin'] = TRUE;
      $_SESSION['name'] = $_POST['Usuario'];
      $_SESSION['id'] = $idUsuarios;
      echo 'Welcome ' . $_SESSION['name'] . '!';
    } else {
      // Incorrect password
      ?>
      <script type="text/javascript">
      window.location.replace("../index.html");
      alert("Usuário ou senha incorreta!");
      </script>
      <?php
    }
  } else {
    // Incorrect username
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