<div class="container-fluid">

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
  <div class="container">
  <div class="row">
  <div class="col col-md-1">
  </div>
  <div class="col col-md-12">
    <table class="table table-hover table-sm">
        <thead class="thead-dark">
            <tr>
              <th scope="col" colspan="4" style="text-align: center; vertical-align: middle;"><h4>Pedido #<?php echo $numeroPedidos ?></h4></th>
            </tr>
        </thead>
        <tbody> <tr><td colspan="4">&nbsp</td></tr> </tbody>
        <thead class="thead-dark">
            <tr>
            <th scope="col" class="col-sm-3" style="text-align: center; vertical-align: middle;"> 
              <button class="btn btn-link" data-toggle="modal" data-target="#modalAdicionar">
                <img src="img/add.png" width="24" height="24">
              </button>
              <button class="btn btn-link" data-toggle="modal" data-target="#modal">
                <img src="img/search.png" width="24" height="24">
              </button>
              <button class="btn btn-link" data-toggle="modal" data-target="#modal">
                <img src="img/update.png" width="24" height="24">
              </button>
            </th>
			      <th scope="col" class="col-md-auto" style="vertical-align: middle;">Item</th>
            <th scope="col" class="col-sm-3" style="vertical-align: middle;">Quantidade</th>
            <th scope="col" class="col-sm-3" style="vertical-align: middle;">Preço</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $total = 0.00;
            while ($linha = mysqli_fetch_array($resultado)) {

              $total = $total + $linha['preco'];
                echo '<tr>';
                  echo '<td style="text-align: center;">';
                      //Botao modal: EDITAR
                      echo '<button class="btn btn-link" data-toggle="modal" data-target="#modalEditar" data-id="'.$numeroPedidos.'" data-idprod="'.$linha['idProduto'].'" data-nome="'.$linha['nome'].'" data-qtde="'.$linha['quantidade'].'" data-item="'.$linha['preco_produto'].'" data-preco="'.$linha['preco'].'">';
                        echo '<img src="img/edit.png" width="20" height="20">';
                      echo '</button>';
                     
                      //Botao modal: APAGAR
                      echo '<button class="btn btn-link" data-toggle="modal" data-target="#modalApagar" data-id="'.$numeroPedidos.'" data-idprod="'.$linha['idProduto'].'">';
                      echo '<img src="img/trash.png" width="20" height="20">';
                      echo '</button>';
                  echo '</td>';

                  echo '<td>'.$linha['nome'].'</td>';
                  echo '<td>'.$linha['quantidade'].'</td>';
                  echo '<td>'.$linha['preco'].'</td>';
                echo '</tr>';
            }
            echo '<thead class="thead-dark">';
            echo '<tr>';
              //echo '<th scope="col"></th>';
              //echo '<th scope="col"></th>';
              echo '<th scope="col" colspan="3" style="text-align: right"><strong>TOTAL:&nbsp</strong></th>';
              echo '<th scope="col">'.number_format($total, 2, '.', '').'</th>';
            echo '</tr>';
            echo '</thead>'
        ?>
        </tbody>
    </table>
    </div>
  <div class="col col-md-1">
  </div>
  </div>
  </div>
    
    <!-- MODAL EDITAR -->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Altear Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formEditar" action="database/acao_itens.php" method="post">
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
                    <select class="form-control" id="selectNome" name="selectNome">
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
                    <input type="hidden" class="form-control" id="idProduto" name="idProduto">
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
            <button class="btn btn-primary" type="submit" name="acao" value="Alterar">Salvar</button>
          </div>
        </div>
        </form>
      </div>
    </div>

    <!-- Modal APAGAR -->
    <div class="modal fade" id="modalApagar" tabindex="-1" role="dialog" aria-labelledby="apagarModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Atenção</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4><img src="img/warning.png" width="30" height="30"> Tem certeza que deseja apagar o registro?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <form action="database/acao_itens.php" method="post">
              <input type="hidden" class="form-control" id="idPedido" name="idPedido">
              <input type="hidden" class="form-control" id="idProduto" name="idProduto">
              <button class="btn btn-danger" type="submit" name="acao" value="Excluir">Excluir</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <script>
      $('#modalEditar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        var idProduto = button.data('idprod')
        var nome = button.data('nome')
        var qtde = button.data('qtde')
        var preco = button.data('preco')
        var precoItem = button.data('item')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Alterar item ' + id)
        modal.find('[id="idPedido"]').val(id)
        modal.find('[id="idProduto"]').val(idProduto)
        modal.find('[id="selectNome"]').val(idProduto)
        modal.find('[id="qtde"]').val(qtde)
        modal.find('[id="preco"]').val(preco)
        modal.find('[id="precoItem"]').val(precoItem)
      })

      $('#selectNome').change(function(){
        var precoItem = parseFloat($(this).find(':selected').data('preco')).toFixed(2)
        var qtde = parseInt($('#qtde').val())
        var total = (qtde*precoItem).toFixed(2)
        $('#modalEditar').find('[id="precoItem"]').val(precoItem)
        $('#modalEditar').find('[id="preco"]').val(total)
      });

      $('#qtde').change(function(){
        var qtde = parseInt($(this).val())
        var precoItem = parseFloat($('#precoItem').val()).toFixed(2)
        var total = (precoItem*qtde).toFixed(2)
        $('#modalEditar').find('[id="preco"]').val(total)
      })

      $('#modalApagar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id')
        var idProduto = button.data('idprod') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Apagar item ' + idprod)
        modal.find('[id="idPedido"]').val(id)
        modal.find('[id="idProduto"]').val(idProduto)
      })
    </script>

</div>