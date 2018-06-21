<?php
  
  if (isset($_POST["idUsuario"]))
  {
	 $idUsuario=$_POST["idUsuario"];
  }
  if (isset($_POST["nome"])){
    $nome=$_POST["nome"];
  }
  if (isset($_POST['email'])){
    $email=$_POST['email'];
  }
  if (isset($_POST['cpf'])){
    $cpf=$_POST['cpf'];
  }
  if (isset($_POST['cep'])){
    $cep=$_POST['cep'];
  }
  if (isset($_POST['bairro'])){
    $bairo=$_POST['bairro'];
  }
  if (isset($_POST['numero'])){
    $numero=$_POST['numero'];
  }
  if (isset($_POST['cidade'])){
    $cidade=$_POST['cidade'];
  }
  if (isset($_POST['logradouro'])){
    $logradouro=$_POST['logradouro'];
  }
  if (isset($_POST['complemento'])){
    $complemento=$_POST['complemento'];
  }
  if (isset($_POST['telefone'])){
    $telefone=$_POST['telefone'];
  }
  if (isset($_POST['celular'])){
    $celular=$_POST['celular'];
  }
  if (isset($_POST['senha'])){
    $senha=$_POST['senha'];
  }
  if (isset($_POST['bairro'])){
    $bairro=$_POST['bairro'];
  }
  $acao=$_POST['acao'];
 

  switch ($acao) {

    case "Alterar":
         include("conexao/conexao.php");
         $sql = "UPDATE cliente SET nome='$nome', email='$email', cpf='$cpf', endCep='$cep', endBairro='$bairro', endNumero='$numero', cidade='$cidade', endLogradouro='$logradouro', endComplemento='$complemento', telefone='$telefone', celular='$celular' WHERE idUsuario='$idUsuario'";
         $resultado = mysqli_query($conexao,$sql) or die (mysqli_error($conexao));
         mysqli_close($conexao);
         header("Location: ../clientes.php");
         break;

    case "Excluir":
         include("conexao/conexao.php");
         $sql = "DELETE FROM `cliente` WHERE idUsuario='$idUsuario'";
         $resultado = mysqli_query($conexao,$sql) or die (mysqli_error($conexao));            
         mysqli_close($conexao);
         header("Location: ../clientes.php"); 
         break;

    case "Cadastro":
         include("conexao/conexao.php");
         $sql = "INSERT INTO `cliente` (`telefone`, `celular`, `cidade`, `estado`, `endNumero`, `endBairro`, `endCep`, `endLogradouro`, `endComplemento`, `cpf`, `email`, `senha`, `nome`) VALUES ('$telefone', '$celular', '$cidade', 'SP', '$numero', '$bairro', '$cep', '$logradouro', '$complemento', '$cpf', '$email', '$senha', '$nome')";
         $resultado = mysqli_query($conexao,$sql) or die (mysqli_error($conexao));            
         mysqli_close($conexao);
         header("Location: ../clientes.php"); 
         break;

    case "Cancelar":
         header("Location: index.php");
         break;
  }

?>
