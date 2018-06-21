<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Produtos</title>
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
   
   <?php include('componentes/produtos_listar.php'); ?>

   <!-- MODAL ADICIONAR -->
   <div class="modal fade" id="modalAdicionar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adicionar Produto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="database/acao_produtos.php" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col col-sm-9">
                  <div class="form-group">
                    <label for="nome" class="col-form-label">Produto</label>
                    <input type="text" class="form-control" id="nome" name="nome">
                  </div>
                </div>
                <div class="col col-sm-3">
                  <div class="form-group">
                    <label for="preco" class="col-form-label">Preço</label>
                    <input type="text" class="form-control" id="preco" name="preco">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="descricao" class="col-form-label">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="descricao">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col col-sm-3">
                  <div class="form-group">
                    <label for="nomeCategoria" class="col-form-label">Categoria</label>
                    <select class="form-control" id="nomeCategoria" name="nomeCategoria">
                    <?php
                        include("database/conexao/conexao.php");
                        $query = "SELECT * FROM categoria ORDER BY nomeCategoria";
                        $resultado = mysqli_query($conexao,$query);

                        while ($linha = mysqli_fetch_array($resultado)) {
                            echo '<option value="'.$linha['idCategoria'].'">'.$linha['nomeCategoria'].'</option>';
                        }
                        mysqli_close($conexao);
                    ?>
                    </select>
                    <input type="hidden" class="form-control" id="idCategoria" name="idCategoria">
                  </div>
                </div>
                <div class="col col-sm-9">
                  <div class="form-group">
                    <label for="imagem_file" class="col-form-label">Imagem</label>
                    <input type="file" class="form-control-file form-control-sm" id="imagem_file" name="imagem_file">
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