<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Categorias</title>
    <?php
    session_start();
    if(!isset($_SESSION["logado"]) || $_SESSION["logado"] != TRUE)
        header("Location: home.php");
    ?>
</head>
<body>
    <?php 
        //include("database/conexao/conexao.php");
        include('componentes/navbar.php'); 
        //include('componentes/clientes_listar.php');
    ?>
  
    <div class="container-fluid">
        <div class="row">
            &nbsp
        </div>
        <div class="row">
            &nbsp
        </div>
    </div>
   
   <?php include('componentes/categorias_listar.php'); ?>

   <!-- MODAL EDITAR -->
   <div class="modal fade" id="modalAdicionar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adicionar Categoria</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="database/acao_categorias.php" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="nomeCategoria" class="col-form-label">Categoria</label>
                    <input type="text" class="form-control" id="nomeCategoria" name="nomeCategoria">
                  </div>
                </div>
              </div> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-primary" type="submit" name="acao" value="Cadastro">Salvar</button>
          </div>
          </form>
        </div>
      </div>
    </div>

   </body>
</html>