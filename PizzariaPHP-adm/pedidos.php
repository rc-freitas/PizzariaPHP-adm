<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pedidos</title>
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
   
   <?php include('componentes/pedidos_listar.php'); ?>

   <!-- MODAL ADICIONAR -->
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
            <form action="database/acao_pedidos.php" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="cliente" class="col-form-label">Cliente</label>
                    <select id="cliente" class="form-control" name="cliente">
                      <?php
                        include("database/conexao/conexao.php");
                        $query = "SELECT idUsuario, nome FROM cliente ORDER BY nome";
                        $resultado = mysqli_query($conexao,$query);

                        while ($linha = mysqli_fetch_array($resultado)) {
                            echo '<option value="'.$linha['idUsuario'].'">'.$linha['nome'].'</option>';
                        }
                        mysqli_close($conexao);
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col col-sm-6">
                  <div class="form-group">
                    <label for="tipoPagamento" class="col-form-label">Tipo de Pagamento</label>
                    <select id="tipoPagamento" class="form-control" name="tipoPagamento">
                            <option selected>Dinheiro</option>
                            <option>Crédito</option>
                            <option>Débito</option>
                    </select>
                  </div>
                </div>
                <div class="col col-sm-6">

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