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
            <th scope="col" style="vertical-align: middle;">CPF</th>
            <th scope="col" style="vertical-align: middle;">Nome</th>
            <th scope="col" style="vertical-align: middle;">Endereço</th>
            <th scope="col" style="vertical-align: middle;">Cidade</th>
            <th scope="col" style="vertical-align: middle;">Telefone</th>
            <th scope="col" style="vertical-align: middle;">Celular</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $query = "SELECT * FROM cliente ORDER BY nome";
            $resultado = mysqli_query($conexao,$query);

            while ($linha = mysqli_fetch_array($resultado)) {
                echo '<tr>';
                  echo '<td style="text-align: center;">';
                      //Botao modal: EDITAR
                      echo '<button class="btn btn-link" data-toggle="modal" data-target="#modalEditar" data-id="'.$linha['idUsuario'].'" data-nome="'.$linha['nome'].'" data-cpf="'.$linha['cpf'].'" data-logradouro="'.$linha['endLogradouro'].'" data-numero="'.$linha['endNumero'].'" data-complemento="'.$linha['endComplemento'].'" data-bairro="'.$linha['endBairro'].'" data-cidade="'.$linha['cidade'].'" data-estado="'.$linha['estado'].'" data-cep="'.$linha['endCep'].'" data-email="'.$linha['email'].'" data-telefone="'.$linha['telefone'].'" data-celular="'.$linha['celular'].'">';
                        echo '<img src="img/edit.png" width="20" height="20">';
                      echo '</button>';
                     
                      //Botao modal: APAGAR
                      echo '<button class="btn btn-link" data-toggle="modal" data-target="#modalApagar" data-id="'.$linha['idUsuario'].'">';
                      echo '<img src="img/trash.png" width="20" height="20">';
                      echo '</button>';
                  echo '</td>';

                  echo '<td>'.$linha['idUsuario'].'</td>';
                  echo '<td>'.$linha['cpf'].'</td>';
                  echo '<td>'.$linha['nome'].'</td>';
                  echo '<td>'.$linha['endLogradouro'].', '.$linha['endNumero'].' - '.$linha['endComplemento'].'</td>';
                  echo '<td>'.$linha['cidade'].'</td>';
                  echo '<td>'.$linha['telefone'].'</td>';
                  echo '<td>'.$linha['celular'].'</td>';
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
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Altear usuário</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="database/acao_clientes.php" method="post">
              <input type="hidden" class="form-control" id="idUsuario" name="idUsuario">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="nome" class="col-form-label">Nome</label>
                    <input type="text" class="form-control" name = "nome" id="nome">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="cpf" class="col-form-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="logradouro" class="col-form-label">Logradouro</label>
                    <input type="text" class="form-control" id="logradouro" name="logradouro">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="numero" class="col-form-label">Nº</label>
                    <input type="text" class="form-control" id="numero" name="numero">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="complemento" class="col-form-label">Complemento</label>
                    <input type="text" class="form-control" id="complemento" name="complemento">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="bairro" class="col-form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="cep" class="col-form-label">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="cidade" class="col-form-label">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="estado" class="col-form-label">Estado</label>
                    <select id="estado" class="form-control" name="estado">
                            <option selected>SP</option>
                            <option>SP</option>
                            <option>SP</option>
                            <option>SP</option>
                            <option>SP</option>
                            <option>SP</option>
                            <option>SP</option>
                            <option>SP</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="email" class="col-form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="telefone" class="col-form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="celular" class="col-form-label">Celular</label>
                    <input type="text" class="form-control" id="celular" name="celular">
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
            <form action="database/acao_clientes.php" method="post">
              <input type="hidden" class="form-control" id="idUsuario" name="idUsuario">
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
        var cpf = button.data('cpf')
        var logradouro = button.data('logradouro')
        var numero = button.data('numero')
        var complemento = button.data('complemento')
        var bairro = button.data('bairro')
        var cep = button.data('cep')
        var cidade = button.data('cidade')
        var estado = button.data('estado')
        var email = button.data('email')
        var telefone = button.data('telefone')
        var celular = button.data('celular')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Alterar usuário ' + id)
        modal.find('[id="idUsuario"]').val(id)
        modal.find('[id="nome"]').val(nome)
        modal.find('[id="cpf"]').val(cpf)
        modal.find('[id="logradouro"]').val(logradouro)
        modal.find('[id="numero"]').val(numero)
        modal.find('[id="complemento"]').val(complemento)
        modal.find('[id="bairro"]').val(bairro)
        modal.find('[id="cep"]').val(cep)
        modal.find('[id="cidade"]').val(cidade)
        modal.find('[id="estado"]').val(estado)
        modal.find('[id="email"]').val(email)
        modal.find('[id="telefone"]').val(telefone)
        modal.find('[id="celular"]').val(celular)
      })

      $('#modalApagar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Apagar usuário ' + id)
        modal.find('[id="idUsuario"]').val(id)
      })
    </script>

</div>