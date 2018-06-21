<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Clientes</title>
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
   
   <?php include('componentes/clientes_listar.php'); ?>

   <!-- MODAL EDITAR -->
   <div class="modal fade" id="modalAdicionar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adicionar cliente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="database/acao_clientes.php" method="post">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="nome" class="col-form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome">
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
                    <input type="text" class="form-control" id="numero" name="numero" >
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
                    <label for="senha" class="col-form-label">Senha</label>
                    <input type="text" class="form-control" id="senha" name="senha">
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
            <button class="btn btn-primary" type="submit" name="acao" value="Cadastro">Salvar</button>
          </div>
          </form>
        </div>
      </div>
    </div>

   </body>
</html>