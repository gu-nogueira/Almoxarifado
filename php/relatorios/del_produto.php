<?php 

$data = $_POST;
$prodId = $data['prod_id'];

if ($prodId) {
  include('../connectdb.php');

  $sql = "DELETE FROM produto WHERE idProduto = $prodId";

  if (mysqli_query($con, $sql)) {
    echo json_encode(array('status' => 'ok'));
  } else {
    echo json_encode(array('error' => $sql . mysqli_error($con)));
  }
  mysqli_close($con);
}

?>