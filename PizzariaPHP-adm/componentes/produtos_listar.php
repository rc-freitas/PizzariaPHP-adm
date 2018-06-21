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
            <th scope="col" style="text-align: center; vertical-align: middle;">
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
			      <th scope="col" style="vertical-align: middle;">Código</th>
            <th scope="col" style="vertical-align: middle;">Produto</th>
            <th scope="col" style="vertical-align: middle;">Categoria</th>
            <th scope="col" style="vertical-align: middle;">Preço</th>
            <th scope="col" style="vertical-align: middle;">Descrição</th>
            <th scope="col" style="vertical-align: middle;">Imagem</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $query = "SELECT *, categoria.nomeCategoria AS nomeCategoria, categoria.idCategoria AS idCategoria FROM produto INNER JOIN categoria ON produto.idCategoria=categoria.idCategoria ORDER BY nome";
            $resultado = mysqli_query($conexao,$query);

            while ($linha = mysqli_fetch_array($resultado)) {
                echo '<tr>';
                  echo '<td style="text-align: center;">';
                      //Botao modal: EDITAR
                      echo '<button class="btn btn-link" data-toggle="modal" data-target="#modalEditar" data-id="'.$linha['idProduto'].'" data-nome="'.$linha['nome'].'" data-categoria="'.$linha['idCategoria'].'" data-nomeCategoria="'.$linha['nomeCategoria'].'" data-preco="'.$linha['preco'].'" data-descricao="'.$linha['descricao'].'" data-imagem="'.$linha['imagem'].'">';
                        echo '<img src="img/edit.png" width="20" height="20">';
                      echo '</button>';
                     
                      //Botao modal: APAGAR
                      echo '<button class="btn btn-link" data-toggle="modal" data-target="#modalApagar" data-id="'.$linha['idProduto'].'" data-imagem="'.$linha['imagem'].'">';
                      echo '<img src="img/trash.png" width="20" height="20">';
                      echo '</button>';
                  echo '</td>';

                  echo '<td>'.$linha['idProduto'].'</td>';
                  echo '<td>'.$linha['nome'].'</td>';
                  echo '<td>'.$linha['nomeCategoria'].'</td>';
                  echo '<td>'.$linha['preco'].'</td>';
                  echo '<td>'.$linha['descricao'].'</td>';
                  echo '<td>';
                    echo '<button class="btn btn-link" data-toggle="modal" data-target="#modalImagem" data-imagem="'.$linha['imagem'].'">';
                        echo $linha['imagem'];
                    echo '</button>';
                  echo '</td>';
              echo '</tr>';
            }
            mysqli_close($conexao);
        ?>
        </tbody>
    </table>
    </div>
  <div class="col col-md-1">
  </div>
  </div>
  </div>
  
  <!--MODAL EDITAR -->
  <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <input type="hidden" class="form-control" id="idProduto" name="idProduto">
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
                    <input type="hidden" class="form-control" id="imagem" name="imagem">
                    <label for="imagem_file" class="col-form-label">Imagem</label>
                    <input type="file" class="form-control-file form-control-sm" id="imagem_file" name="imagem_file">
                  </div>
                </div>
              </div>  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-primary" type="submit" name="acao" value="Alterar">Salvar</button>
          </div>
          </form>
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
            <form action="database/acao_produtos.php" method="post">
              <input type="hidden" class="form-control" id="imagem" name="imagem">
              <input type="hidden" class="form-control" id="idProduto" name="idProduto">
              <button class="btn btn-danger" type="submit" name="acao" value="Excluir">Excluir</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal IMAGEM -->
    <div class="modal fade" id="modalImagem" tabindex="-1" role="dialog" aria-labelledby="imagemModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Imagem</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <img class="img-fluid" id="imagem" name="imagem" src="img/warning.png"></h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>
    
    <script>
      $('#modalEditar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        var nome = button.data('nome')
        var nomeCategoria = button.data('nomeCategoria')
        var idCategoria = button.data('categoria')
        var preco = button.data('preco')
        var descricao = button.data('descricao')
        var imagem = button.data('imagem')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Alterar produto ' + id)
        modal.find('[id="idProduto"]').val(id)
        modal.find('[id="nome"]').val(nome)
        modal.find('[id="nomeCategoria"]').val(parseInt(idCategoria))
        modal.find('[id="idCategoria"]').val(idCategoria)
        modal.find('[id="preco"]').val(preco)
        modal.find('[id="descricao"]').val(descricao)
        modal.find('[id="imagem"]').val(imagem)
      })

      $('#modalApagar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        var imagem = button.data('imagem')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Apagar produto ' + id)
        modal.find('[id="idProduto"]').val(id)
        modal.find('[id="imagem"]').val(imagem)
      })

      $('#modalImagem').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        //var id = button.data('id') // Extract info from data-* attributes
        var imagem = button.data('imagem')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //modal.find('.modal-title').text('Apagar produto ' + id)
        //modal.find('[id="idProduto"]').val(id)
        modal.find('[id="imagem"]').attr("src","database/".concat(imagem))
      })
    </script>

</div>