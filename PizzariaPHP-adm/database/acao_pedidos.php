<?php
  
  if (isset($_POST["cliente"]))
  {
	 $idUsuario=$_POST["cliente"];
  }
  if (isset($_POST["tipoPagamento"])){
    $tipoPagamento=$_POST["tipoPagamento"];
  }
  if (isset($_POST["idPedido"]))
  {
	 $idPedido=$_POST["idPedido"];
  }
 
  $acao=$_POST['acao'];
 

  switch ($acao) {

    //case "Alterar":
    //     include("conexao/conexao.php");
    //     $sql = ;
    //     $resultado = mysqli_query($conexao,$sql) or die (mysqli_error($conexao));
    //     mysqli_close($conexao);
    //     header("Location: ../pedido.php");
    //     break;

    case "Excluir":
         include("conexao/conexao.php");
         $sql = "DELETE FROM `itenspedido` WHERE numeroPedido='$idPedido'";
         $resultado = mysqli_query($conexao,$sql) or die (mysqli_error($conexao));
         $sql = "DELETE FROM `pedido` WHERE numeroPedidos='$idPedido'";
         $resultado = mysqli_query($conexao,$sql) or die (mysqli_error($conexao));            
         mysqli_close($conexao);
         header("Location: ../pedidos.php"); 
         break;

    case "Cadastro":
         include("conexao/conexao.php");
         $dataHora = date('Y-m-d H:i:s');
         $sql = "INSERT INTO `pedido` (`dataHora`, `tipoPagamento`, `idUsuario`) VALUES ('$dataHora', '$tipoPagamento', '$idUsuario')";
         echo $sql."  \n\n";
         $resultado = mysqli_query($conexao,$sql) or die (mysqli_error($conexao)); 
         $numeroPedido = mysqli_insert_id($conexao);           
         mysqli_close($conexao);
         session_start();
         $_SESSION['idPedido']=$numeroPedido;
         header("Location: ../itens.php"); 
         break;

    case "Cancelar":
         header("Location: home.php");
         break;
  }

?>
