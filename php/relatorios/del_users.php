<?php 

$data = $_POST;
$userId = $data['user_id'];

if ($userId) {
  include('../connectdb.php');

  $sql = "DELETE FROM usuarios WHERE idUsuarios = $userId";

  if (mysqli_query($con, $sql)) {
    echo json_encode(array('status' => 'ok'));
  } else {
    echo json_encode(array('error' => $sql . mysqli_error($con)));
  }
  mysqli_close($con);
}

?>