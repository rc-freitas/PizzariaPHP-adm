<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Validando...</title>
</head>
<body>
    <?php
    include("conexao/conexao.php");
    session_start();
    $query = "SELECT * FROM administrador ORDER BY nome";
    $resultado = mysqli_query($conexao,$query);
    while ($linha = mysqli_fetch_array($resultado))
    {    
        if($_POST["email"] == $linha['email'] && $_POST["senha"] == $linha['senha'])
        {
            $_SESSION["logado"] = TRUE;
            $_SESSION["nome_usuario"] = $linha['nome'];
            header("Location: ../home.php");    
        }
    }
    if($_SESSION["logado"]== FALSE)
    {
        $_SESSION['Mensagem_erro'] = TRUE;
        header("Location: ../login.php");
    }
    mysqli_close($conexao);
    ?>
</body>
</html>