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
            <th class="col col-sm-3" scope="col" style="text-align: center; vertical-align: middle;">
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
			      <th class="col col-sm-auto" scope="col" style="vertical-align: middle;">Código</th>
            <th class="col col-md-auto" scope="col" style="vertical-align: middle;">Categoria</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $query = "SELECT * FROM categoria ORDER BY nomeCategoria";
            $resultado = mysqli_query($conexao,$query);

            while ($linha = mysqli_fetch_array($resultado)) {
                echo '<tr>';
                  echo '<td style="text-align: center;">';
                      //Botao modal: EDITAR
                      echo '<button class="btn btn-link" data-toggle="modal" data-target="#modalEditar" data-id="'.$linha['idCategoria'].'" data-nome="'.$linha['nomeCategoria'].'">';
                        echo '<img src="img/edit.png" width="20" height="20">';
                      echo '</button>';
                     
                      //Botao modal: APAGAR
                      echo '<button class="btn btn-link" data-toggle="modal" data-target="#modalApagar" data-id="'.$linha['idCategoria'].'">';
                      echo '<img src="img/trash.png" width="20" height="20">';
                      echo '</button>';
                  echo '</td>';

                  echo '<td>'.$linha['idCategoria'].'</td>';
                  echo '<td>'.$linha['nomeCategoria'].'</td>';
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
    
    <!-- MODAL EDITAR -->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Altear Categoria</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="database/acao_categorias.php" method="post">
              <input type="hidden" class="form-control" id="idCategoria" name="idCategoria">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="nomeCategoria" class="col-form-label">Nome da Categoria</label>
                    <input type="text" class="form-control" name="nomeCategoria" id="nomeCategoria">
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
            <form action="database/acao_categorias.php" method="post">
              <input type="hidden" class="form-control" id="idCategoria" name="idCategoria">
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
        var nome = button.data('nome')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Alterar categoria ' + id)
        modal.find('[id="idCategoria"]').val(id)
        modal.find('[id="nomeCategoria"]').val(nome)
      })

      $('#modalApagar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Apagar categoria ' + id)
        modal.find('[id="idCategoria"]').val(id)
      })
    </script>

</div>