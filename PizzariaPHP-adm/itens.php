<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pedidos</title>
    <?php
    session_start();
    if(!isset($_SESSION["logado"]) || $_SESSION["logado"] != TRUE)
        header("Location: home.php");
    //echo $_SESSION['idProduto'];
    ?>
</head>
<body>
    <?php 
        //include("database/conexao/conexao.php");
        include('componentes/navbar.php'); 
        //include('componentes/clientes_listar.php');
    ?>

    <?php
        include("database/conexao/conexao.php");

        if(isset($_POST['numeroPedidos'])){
          $numeroPedidos = $_POST['numeroPedidos'];
          $_SESSION['idPedido']=$numeroPedidos;
        }else{
          //session_start();
          $numeroPedidos=$_SESSION['idPedido'];
        }

        $query = "SELECT itenspedido.*, produto.nome AS nome, produto.preco AS preco_produto FROM itenspedido INNER JOIN produto ON itenspedido.idProduto=produto.idProduto WHERE numeroPedido='$numeroPedidos'";
        $resultado = mysqli_query($conexao,$query);
?>
  
    <div class="container-fluid">
        <div class="row">
            &nbsp
        </div>
        <div class="row">
            &nbsp
        </div>
        <!--
        <div class="row align-items-center">
            <div class="col">
              
            </div>
            <div class="col">
                <button class="btn btn-link" data-toggle="modal" data-target="#modalAdicionar" data-id="<?php echo $numeroPedidos ?>">
                    <img src="img/add.png" width="64" height="64">
                </button>
            </div>
            <div class="col">
              
            </div>
            <div class="col">
              <img src="img/search.png" width="64" height="64">
            </div>
            <div class="col">
              
            </div>
       </div>
       <div class="row">
            &nbsp
        </div>
          -->
    </div>
  
   <?php include('componentes/itens_listar.php'); ?>
  
  <!-- MODAL ADICIONAR -->
  <div class="modal fade" id="modalAdicionar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adicionar Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formAdicionar" action="database/acao_itens.php" method="post">
              <input type="hidden" class="form-control" id="idPedido" name="idPedido">
              <div class="row">
                <div class="col col-sm-2">
                  <div class="form-group">
                    <label for="qtde" class="col-form-label">Qtde.</label>
                    <input type="text" class="form-control" name="qtde" id="qtde">
                  </div>
                </div>
                <div class="col col-sm-7">
                  <div class="form-group">
                    <label for="nome" class="col-form-label">Produto</label>
                    <select class="form-control" id="idProduto" name="idProduto">
                    <?php
                        include("database/conexao/conexao.php");
                        $query = "SELECT idProduto, nome, preco FROM produto ORDER BY nome";
                        $resultado = mysqli_query($conexao,$query);

                        while ($linha = mysqli_fetch_array($resultado)) {
                            echo '<option value="'.$linha['idProduto'].'" data-preco="'.$linha['preco'].'">'.$linha['nome'].'</option>';
                        }
                        mysqli_close($conexao);
                    ?>
                    </select>                  
                  </div>
                </div>
                <div class="col col-sm-3">
                  <div class="form-group">
                    <label for="precoItem" class="col-form-label">Preço Unit.</label>
                    <input type="text" class="form-control" name="precoItem" id="precoItem" readonly>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col col-sm-9">
                </div>
                <div class="col col-sm-3">
                    <div class="form-group">
                      <label for="preco" class="col-form-label">Total</label>
                      <input type="text" class="form-control" name="preco" id="preco" readonly>
                    </div>
                  </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-primary" type="submit" name="acao" value="Cadastro">Salvar</button>
          </div>
        </div>
        </form>
      </div>
    </div>

    <script>
      $('#formAdicionar select[name="idProduto"]').change(function(){
        var precoItem = parseFloat($(this).find(':selected').data('preco')).toFixed(2)
        var qtde = parseInt($('#formAdicionar input[name="qtde"]').val())
        var total = (qtde*precoItem).toFixed(2)
        $('#modalAdicionar').find('[id="precoItem"]').val(precoItem)
        $('#modalAdicionar').find('[id="preco"]').val(total)
      });

      $('#formAdicionar input[id="qtde"]').change(function(){
        var qtde = parseInt($(this).val())
        var precoItem = parseFloat($('#precoItem').val()).toFixed(2)
        var total = (precoItem*qtde).toFixed(2)
        $('#modalAdicionar').find('[id="preco"]').val(total)
      })

      $('#modalAdicionar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = <?php echo $numeroPedidos ?> //$('#modalEditar hidden[id="idPedido"]').val() // Extract info from data-* attributes
        var modal = $(this)
        modal.find('.modal-title').text('Adicionar item no pedido #' + id)
        modal.find('[id="idPedido"]').val(id)
      })
    </script>

   </body>
</html>