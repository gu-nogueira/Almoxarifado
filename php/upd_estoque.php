
<?php

  $data = $_POST;
  $requisicao = $data['requisicao'];
  $id_requisitante = $requisicao['id_requisitante'];
  $requisitante = $requisicao['requisitante'];
  $data_retirada = $requisicao['data_retirada'];

  // arrays
  $id_produtos = $requisicao['id_produtos'];
  $produtos = $requisicao['produtos'];
  $qtd_produtos = $requisicao['qtd_produtos'];
  $atualizado = $requisicao['estoque'];

  $sql = "INSERT INTO requisicao (Data_retirada, Requisitante_idRequisitante) VALUES ('$data_retirada', '$id_requisitante')";

  if ($requisicao) {
    include('connectdb.php');

    if (mysqli_query($con, $sql)) {

      $id_requisicao = mysqli_insert_id($con);
      $quant = count($produtos);

      for($i=0;$i<$quant;$i++){
        mysqli_query($con, "INSERT INTO requisita (Produto_idProduto, Qtde_requisita,	Requisicao_idRequisicao) VALUES ('$id_produtos[$i]', '$qtd_produtos[$i]', '$id_requisicao')");
        mysqli_query($con, "UPDATE produto SET Qtde_estoque='$atualizado[$i]' WHERE idProduto='$id_produtos[$i]'");
      }

      echo json_encode(array('status' => 'ok'));
    } else {
      echo json_encode(array('error' => $sql . mysqli_error($con)));
    }
    mysqli_close($con);
  }
?>