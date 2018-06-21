<div class="container-fluid">

    <?php
            include("database/conexao/conexao.php");
    ?>
  <div class="container">
  <div class="row">
  <div class="col col-md-1">
  </div>
  <div class="col col-md-12">
    <table class="table table-hover table-sm">
        <thead class="thead-dark">
            <tr>
            <th scope="col" class="col-sm-auto" style="text-align: center; vertical-align: middle;"> 
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
			      <th scope="col" class="col-md-auto" style="vertical-align: middle;">Data - Hora</th>
            <th scope="col" class="col-sm-auto" style="vertical-align: middle;">Pedido</th>
            <th scope="col" class="col-lg-auto" style="vertical-align: middle;">Cliente</th>
            <th scope="col" class="col-md-auto" style="vertical-align: middle;">Pagamento</th>
            <th scope="col" class="col-md-auto" style="vertical-align: middle;">Total</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $query = "SELECT *, cliente.nome AS cliente FROM pedido INNER JOIN cliente ON pedido.idUsuario=cliente.idUsuario ORDER BY dataHora";
            $resultado = mysqli_query($conexao,$query);

            while ($linha = mysqli_fetch_array($resultado)) {
              $id = $linha['numeroPedidos'];
              $q_itens = "SELECT preco FROM itenspedido WHERE numeroPedido='$id'";
              $itens = mysqli_query($conexao, $q_itens);
              $total = 0;
              while($item = mysqli_fetch_array($itens)){
                $total=$total+$item['preco'];
              }

                echo '<tr>';
                  echo '<td style="text-align:center;">';
                      //Botao modal: EDITAR
                      echo '<form action="itens.php" method="post">';
                        echo '<input type="hidden" class="form-control" id="inp_pedido'.$linha['numeroPedidos'].'" name="numeroPedidos" value="'.$linha['numeroPedidos'].'">';
                        echo '<button class="btn btn-link" type="submit" name="acao" value="Listar" id="btn_pedido_'.$linha['numeroPedidos'].'">';
                        //echo '<button class="btn btn-link" data-toggle="modal" data-target="#modalEditar" data-id="'.$linha['numeroPedidos'].'" data-idUsuario="'.$linha['idUsuario'].'" data-tipoPagamento="'.$linha['tipoPagamento'].'">';
                          echo '<img src="img/edit.png" width="20" height="20">';
                        echo '</button>';
                      //echo '</form>';
                     
                      //Botao modal: APAGAR
                      echo '<a href="#" class="btn btn-link" data-toggle="modal" data-target="#modalApagar" data-id="'.$linha['numeroPedidos'].'">';
                      echo '  <img src="img/trash.png" width="20" height="20">';
                      echo '</a>';
                      echo '</form>';
                  echo '</td>';
                  echo '<td>'.$linha['dataHora'].'</td>';
                  echo '<td>';
                      //echo '<form action="itens.php" method="post">';
                      //  echo '<input type="hidden" class="form-control" id="inp_pedido'.$linha['numeroPedidos'].'" name="numeroPedidos" value="'.$linha['numeroPedidos'].'">';
                      //  echo '<button class="btn btn-link" type="submit" name="acao" value="Listar" id="btn_pedido_'.$linha['numeroPedidos'].'">';
                          echo $linha['numeroPedidos'];
                      //  echo '</button>';
                      //echo '</form>';
                  echo '</td>';
                  echo '<td>'.$linha['cliente'].'</td>';
                  echo '<td>'.$linha['tipoPagamento'].'</td>';
                  echo '<td>'.number_format($total, 2, '.', '').'</td>';
              echo '</tr>';
            }
        ?>
        </tbody>
    </table>
    </div>
  <div class="col col-md-1">
  </div>
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
            <form action="database/acao_pedidos.php" method="post">
              <input type="hidden" class="form-control" id="idPedido" name="idPedido">
              <button class="btn btn-danger" type="submit" name="acao" value="Excluir">Excluir</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <script>
      $('#modalApagar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Apagar pedido ' + id)
        modal.find('[id="idPedido"]').val(id)
      })

    </script>

</div>