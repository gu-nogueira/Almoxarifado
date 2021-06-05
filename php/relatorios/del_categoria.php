<?php 

$data = $_POST;
$catId = $data['cat_id'];

if ($catId) {
  include('../connectdb.php');

  $queryProdutos = $con->query("SELECT Categoria_idCategoria FROM `produto` WHERE Categoria_idCategoria = '$catId'");

  $reg = $queryProdutos->fetch_assoc();

  if ($reg == NULL) {
  
    $sql = "DELETE FROM categoria WHERE idCategoria = $catId";
  
    if (mysqli_query($con, $sql)) {
      echo json_encode(array('status' => 'ok'));
    } else {
      echo json_encode(array('error' => $sql . mysqli_error($con)));
    }
    
  } else {
    echo json_encode(array('error' => 'produtos ainda usam essa categoria'));
  }
  mysqli_close($con);
}

?>