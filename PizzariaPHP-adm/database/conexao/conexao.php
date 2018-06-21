<?php
$conexao = mysqli_connect("localhost","root","","pizzariabd");
if (mysqli_connect_errno())
  {
  echo "Falha na conexão com o banco de dados: " . mysqli_connect_error();
  }

?>
