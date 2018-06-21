<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <?php
    session_start();
    if(!isset($_SESSION["logado"]) || $_SESSION["logado"] != TRUE)
        //header("Location: index.php");
    ?>
</head>
<body>
   <?php include('componentes/navbar.php'); ?>
    <div class="container-fluid" id="header">
        <div class="row align-items-center">
            <div class="col">
              <h1>Pizzaria FATEC(Aqui virá o logo futuramente)</h1>
              <p>Uma descrição daora sobre a pizzaria aqui</p>
            </div>
       </div>
    </div>
   
   <?php //include('componentes/carousel.php'); ?>
   <?php //include('componentes/cardapio_home.php'); ?>
   </body>
</html>