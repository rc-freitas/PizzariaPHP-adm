<?php
  // php.in ==> file_uploads = On 
  if (isset($_POST["idProduto"]))
  {
	 $idProduto=$_POST["idProduto"];
  }
  if (isset($_POST["nome"])){
    $nome=$_POST["nome"];
  }
  if (isset($_POST["preco"])){
    $preco=$_POST["preco"];
  }
  if (isset($_POST["descricao"])){
    $descricao=$_POST["descricao"];
  }
  if (isset($_POST["nomeCategoria"])){
    $idCategoria=$_POST["nomeCategoria"];
  }
  if (isset($_POST["imagem"])){
    $imagem=$_POST["imagem"];
  }//else{$imagems="imagem generica";}
 
  $acao=$_POST['acao'];
 
  function carregar_arquivo($arquivo){
    $target_dir = "\img";
    if ($arquivo['size']!=0){
        $file_link = "img/"."prod_".date("Y-m-d") .time("h-i-s")."_".basename($arquivo["name"]);
        $target_file = "\img\\"."prod_".date("Y-m-d") .time("h-i-s")."_".basename($arquivo["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        //if(isset($_POST["submit"])) {
            $check = getimagesize($arquivo["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        //}
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($arquivo["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else { 
            if (move_uploaded_file($arquivo["tmp_name"], realpath(dirname(__FILE__)).$target_file)) {
                echo "The file ". basename($arquivo["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }else{$file_link = $target_dir."/imagem_nao_cadastrada.png";}

    return $file_link;
  }

  switch ($acao) {

    case "Alterar":
        echo "tamanho :".$_FILES["imagem_file"]['size']."   ";
         include("conexao/conexao.php");

        if($_FILES["imagem_file"]['size']==0){
            $sql = "UPDATE produto SET nome='$nome', preco='$preco', descricao='$descricao', idCategoria='$idCategoria'  WHERE idProduto='$idProduto'";
            $resultado = mysqli_query($conexao,$sql) or die (mysqli_error($conexao));
            echo "nenhum arquivo escolhido";
        }else{
            $file_link = carregar_arquivo($_FILES["imagem_file"]);
            $sql = "UPDATE produto SET nome='$nome', preco='$preco', descricao='$descricao', idCategoria='$idCategoria', imagem='$file_link' WHERE idProduto='$idProduto'";
            $resultado = mysqli_query($conexao,$sql) or die (mysqli_error($conexao));
            echo $_FILES["imagem_file"]["name"];
        }
         mysqli_close($conexao);
         //header("Location: ../produtos.php");
         break;

    case "Excluir":
         include("conexao/conexao.php");
         $sql = "DELETE FROM `produto` WHERE idProduto='$idProduto'";
         $resultado = mysqli_query($conexao,$sql) or die (mysqli_error($conexao));
         //echo $imagem;
         if($resultado && isset($_POST["imagem"]) && $imagem!="img/pizza-Pizza de Queijo.png"){
             unlink($imagem);
             //echo "apagado";
         }
         mysqli_close($conexao);
         header("Location: ../produtos.php"); 
         break;

    case "Cadastro":
        include("conexao/conexao.php");
        $file_link = carregar_arquivo($_FILES["imagem_file"]);
         $sql = "INSERT INTO produto (nome, preco, descricao, idCategoria, imagem) VALUES ('$nome', '$preco', '$descricao', '$idCategoria', '$file_link')";
         $resultado = mysqli_query($conexao,$sql) or die (mysqli_error($conexao));            
         mysqli_close($conexao);
         header("Location: ../produtos.php"); 
         break;

    case "Cancelar":
         header("Location: home.php");
         break;
  }

?>
