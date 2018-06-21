<!DOCTYPE html>
<html>
<head>
	<title>Aula PHP - Session</title>
    <meta charset="utf-8"/>
    <?php
    session_start();
    if(!isset($_SESSION["Mensagem_erro"]))
        $_SESSION["Mensagem_erro"] = FALSE;
    ?>
</head>
<body>
  <?php include('componentes/navbar.php');?>
    <h1 align="center">Entrar</h1>
    
    <form action="database/validalogin.php" method="post" class="container" id="formulario">
        <div class="form-group">
            <label for="email">Endereço de E-mail</label>
            <input type="text" class="form-control" id="email" placeholder="E-mail" name="email" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha" placeholder="Senha" name="senha" required>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Manter conectado (implementar apenas se der)</label>
        </div>
           <div class="form-group">
              <button type="submit" class="btn btn-primary btn-lg btn-block">Entrar</button>   
           </div>
    </form>
    <?php
    if($_SESSION["Mensagem_erro"] == TRUE)
    {
        echo "<p align='center' style='color:red;'><strong>E-mail ou Senha inválido(os)</strong></p>";
        $_SESSION["Mensagem_erro"] = FALSE;
    }
    
    ?>
</body>
</html>