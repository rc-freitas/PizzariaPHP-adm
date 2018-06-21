<?php
  
  if (isset($_POST["idCategoria"]))
  {
	 $idCategoria=$_POST["idCategoria"];
  }
  if (isset($_POST["nomeCategoria"])){
    $nome=$_POST["nomeCategoria"];
  }
 
  $acao=$_POST['acao'];
 

  switch ($acao) {

    case "Alterar":
         include("conexao/conexao.php");
         $sql = "UPDATE categoria SET nomeCategoria='$nome' WHERE idCategoria='$idCategoria'";
         $resultado = mysqli_query($conexao,$sql) or die (mysqli_error($conexao));
         mysqli_close($conexao);
         header("Location: ../categorias.php");
         break;

    case "Excluir":
         include("conexao/conexao.php");
         $sql = "DELETE FROM `categoria` WHERE idCategoria='$idCategoria'";
         $resultado = mysqli_query($conexao,$sql) or die (mysqli_error($conexao));            
         mysqli_close($conexao);
         header("Location: ../categorias.php"); 
         break;

    case "Cadastro":
         include("conexao/conexao.php");
         $sql = "INSERT INTO `categoria` (`nomeCategoria`) VALUES ('$nome')";
         $resultado = mysqli_query($conexao,$sql) or die (mysqli_error($conexao));            
         mysqli_close($conexao);
         header("Location: ../categorias.php"); 
         break;

    case "Cancelar":
         header("Location: home.php");
         break;
  }

?>
