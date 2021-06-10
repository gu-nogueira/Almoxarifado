<?php 

$data = $_POST;
$reqId = $data['req_id'];

if ($reqId) {
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