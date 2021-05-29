<?php 

$data = $_POST;
$fornecId = $data['fornec_id'];

if ($fornecId) {
  include('../connectdb.php');

  $sql = "DELETE FROM fornecedor WHERE idFornecedor= $fornecId";

  if (mysqli_query($con, $sql)) {
    echo json_encode(array('status' => 'ok'));
  } else {
    echo json_encode(array('error' => $sql . mysqli_error($con)));
  }
  mysqli_close($con);
}

?>