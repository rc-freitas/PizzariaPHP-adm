<?php
  
  if (isset($_POST["idPedido"]))
  {
	 $idPedido=$_POST["idPedido"];
  }
  if (isset($_POST["selectNome"])){
    $novoProduto=$_POST["selectNome"];
  }
  if (isset($_POST["idProduto"])){
    $idProduto=$_POST["idProduto"];
  }
  if (isset($_POST["qtde"])){
    $qtde=$_POST["qtde"];
  }
  if (isset($_POST["preco"])){
    $preco=$_POST["preco"];
  }

  $_SESSION["idPedido"]=$idPedido;
 
  $acao=$_POST['acao'];
 

  switch ($acao) {

    case "Alterar":
         include("conexao/conexao.php");
         $sql = "UPDATE itenspedido SET quantidade='$qtde', preco='$preco', idProduto='$novoProduto' WHERE numeroPedido='$idPedido' AND idProduto='$idProduto'";
         $resultado = mysqli_query($conexao,$sql) or die (mysqli_error($conexao));
         mysqli_close($conexao);
         header("Location: ../itens.php");
         break;

    case "Excluir":
         include("conexao/conexao.php");
         $sql = "DELETE FROM `itenspedido` WHERE numeroPedido='$idPedido' AND idProduto='$idProduto'";
         $resultado = mysqli_query($conexao,$sql) or die (mysqli_error($conexao));            
         mysqli_close($conexao);
         header("Location: ../itens.php"); 
         break;

    case "Cadastro":
         include("conexao/conexao.php");
         $sql = "INSERT INTO `itenspedido` (`numeroPedido`, `idProduto`, `preco`, `quantidade`) VALUES ('$idPedido', '$idProduto', '$preco', '$qtde')";
        $resultado = mysqli_query($conexao,$sql) or die (mysqli_error($conexao));            
         mysqli_close($conexao);
         header("Location: ../itens.php"); 
         break;

    case "Cancelar":
         header("Location: home.php");
         break;
  }

?>
