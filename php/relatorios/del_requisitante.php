<?php 

$data = $_POST;
$requisId = $data['requis_id'];

if ($requisId) {
  include('../connectdb.php');

  $validator = false;
  $reqs = $con->query("SELECT * FROM requisicao WHERE Requisitante_idRequisitante = $requisId");

  if ($reqs->fetch_assoc() == NULL) {
    $validator = true;
  }

  $reqs = $con->query("SELECT * FROM requisicao WHERE Requisitante_idRequisitante = $requisId");
  while($req = $reqs->fetch_assoc()){

    $reqId = $req['idRequisicao'];
    $sql = "DELETE FROM requisicao WHERE idRequisicao = $reqId";

    if (mysqli_query($con, $sql)) {
      $sql = "DELETE FROM requisita WHERE Requisicao_idRequisicao = $reqId"; 
      if (mysqli_query($con, $sql)) {
        $validator = true;
      } else {
        echo json_encode(array('error' => $sql . mysqli_error($con)));
      }
    } else {
      echo json_encode(array('error' => $sql . mysqli_error($con)));
    }
  }

  if ($validator) {
    $sql = "DELETE FROM requisitante WHERE idRequisitante = $requisId";
    if (mysqli_query($con, $sql)) {
      echo json_encode(array('status' => 'ok'));
    } else {
      echo json_encode(array('error' => $sql . mysqli_error($con)));
    }
  }
  mysqli_close($con);
}

?>


