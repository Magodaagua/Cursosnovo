<!doctype html>
<html lang="pt-br">
  <head>
    <?php 
        include_once "../conexao.php";
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Inicial</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/dashboard/">
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!--coloca o icone na aba da tela-->
    <link rel="icon" type="png" href="../logo/logo_copi.png">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="../menu.php">Portal do Administrador</a>
      <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sairModal">Sair</button>
        </li>
      </ul>
    </nav>
        <!-- Modal para sair--> 
        <div class="modal fade" id="sairModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="exampleModalLabel">Deseja mesmo sair de sua conta?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continuar na conta</button>
                        <a href="logout.php"><button type="button"class="btn btn-primary">Sair da conta</button></a>
                    </div>
                </div>
            </div>
        </div> 
        <!--fim modal para sair-->

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="../menu.php">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only"></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../parceiros/treinamentoexterno.php">
              <span data-feather="file"></span>
              Treinamento Externo
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../cursos/treinamentointerno.php">
              <span data-feather="file"></span>
              Treinamento Interno
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../usuarios/usuarios.php">
              <span data-feather="users"></span>
              Usuários Cadastrados
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../categorias/categoria.php">
              <span data-feather="bar-chart-2"></span>
              Categorias
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../administrador/administrador.php">
              <span data-feather="layers"></span>
              Administrador
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link active" href="inicial.php">
              <span data-feather="file-text">(current)</span>
              Inicial
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../rodape/rodape.php">
              <span data-feather="file-text"></span>
              Rodapé
            </a>
          </li>
        </ul>
      </div>
    </nav>

   
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="container">
                <div class="row mt-4">
                    <div class="col-lg-12 d-flex justify-content-between align-items-center">
                        <div>
                            <h4>Tela inicial</h4>
                        </div>
                    </div>
                </div>
                <hr>
                <span id="msgAlerta"></span>
                <div class="row">
                    <div class="col-lg-12">
                        <span class="listar-menu"></span>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="visMenuModal" tabindex="-1" aria-labelledby="visMenuModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="visMenuModalLabel">Detalhes do Menu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span id="msgAlertaErroVis"></span>
                            <dl class="row">
                            <dt class="col-sm-3">ID :</dt>
                                <dd class="col-sm-9"><span id="visID_menu"></span></dd>

                                <dt class="col-sm-3">Texto 1:</dt>
                                <dd class="col-sm-9"><span id="vistexto1"></span></dd>

                                <dt class="col-sm-3">Texto 2:</dt>
                                <dd class="col-sm-9"><span id="vistexto2"></span></dd>

                                <dt class="col-sm-3">Texto 3:</dt>
                                <dd class="col-sm-9"><span id="vistexto3"></span></dd>

                                <dt class="col-sm-3">Titulo 1:</dt>
                                <dd class="col-sm-9"><span id="vistitulo1"></span></dd>

                                <dt class="col-sm-3">Titulo 2:</dt>
                                <dd class="col-sm-9"><span id="vistitulo2"></span></dd><br>

                                <dt class="col-sm-3">Titulo 3:</dt>
                                <dd class="col-sm-9"><span id="vistitulo3"></span></dd>

                                <dt class="col-sm-3">Imagem 1:</dt>
                                <dd class="col-sm-9"><span id="visimagem1"></span></dd>

                                <dt class="col-sm-3">Imagem 2:</dt>
                                <dd class="col-sm-9"><span id="visimagem2"></span></dd>

                                <dt class="col-sm-3">Imagem 3:</dt>
                                <dd class="col-sm-9"><span id="visimagem3"></span></dd>

                                <dt class="col-sm-3">Carrosel 1:</dt>
                                <dd class="col-sm-9"><span id="viscarrosel1"></span></dd>

                                <dt class="col-sm-3">Carrosel 2:</dt>
                                <dd class="col-sm-9"><span id="viscarrosel2"></span></dd>

                                <dt class="col-sm-3">Carrosel 3:</dt>
                                <dd class="col-sm-9"><span id="viscarrosel3"></span></dd>

                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editMenuModal" tabindex="-1" aria-labelledby="editMenuModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                             <h5 class="modal-title" id="editMenuModalLabel">Editar Empresa Parceira</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div> 
                        <div class="modal-body">
                            <form id="edit-menu-form" method="POST" action="" enctype="multipart/form-data">
                                <span id="msgAlertaErroEdit"></span>
                                <input type="hidden" name="ID_menu" id="editId">
                                <div class="mb-3">
                                    <label for="texto1" class="col-form-label">Texto 1:</label>
                                    <input type="text" name="texto1" class="form-control" id="editTexto1" placeholder="Digite o Texto 1">
                                </div>
                                <div class="mb-3">
                                    <label for="texto2" class="col-form-label">Texto 2:</label>
                                    <input type="text" name="texto2" class="form-control" id="editTexto2" placeholder="Digite o Texto 2">
                                </div>
                                <div class="mb-3">
                                    <label for="texto3" class="col-form-label">Texto 3:</label>
                                    <input type="text" name="texto3" class="form-control" id="editTexto3" placeholder="Digite o Texto 3">
                                </div>
                                <div class="mb-3">
                                    <label for="titulo1" class="col-form-label">Titulo 1:</label>
                                    <input type="text" name="titulo1" class="form-control" id="editTitulo1" placeholder="Digite o Título 1">
                                </div>
                                <div class="mb-3">
                                    <label for="titulo2" class="col-form-label">Titulo 2:</label>
                                    <input type="text" name="titulo2" class="form-control" id="editTitulo2" placeholder="Digite o Título 2">
                                </div>
                                <div class="mb-3">
                                    <label for="titulo3" class="col-form-label">Titulo 3:</label>
                                    <input type="text" name="titulo3" class="form-control" id="editTitulo3" placeholder="Digite o Título 3">
                                </div>
                                <div class="mb-3">
                                    <label for="imagem1" class="col-form-label">Imagem 1:</label>
                                    <input type="file" name="imagem1" class="form-control" id="editImagem1" placeholder="Escolha uma imagem">
                                </div>
                                <div class="mb-3">
                                    <label for="imagem2" class="col-form-label">Imagem 2:</label>
                                    <input type="file" name="imagem2" class="form-control" id="editImagem2" placeholder="Escolha uma imagem">
                                </div>
                                <div class="mb-3">
                                    <label for="imagem3" class="col-form-label">Imagem 3:</label>
                                    <input type="file" name="imagem3" class="form-control" id="editImagem3" placeholder="Escolha uma imagem">
                                </div>
                                <div class="mb-3">
                                    <label for="carrosel1" class="col-form-label">Carrosel 1:</label>
                                    <input type="file" name="carrosel1" class="form-control" id="editCarrosel1" placeholder="Escolha uma imagem">
                                </div>
                                <div class="mb-3">
                                    <label for="carrosel2" class="col-form-label">Carrosel 2:</label>
                                    <input type="file" name="carrosel2" class="form-control" id="editCarrosel2" placeholder="Escolha uma imagem">
                                </div>
                                <div class="mb-3">
                                    <label for="carrosel3" class="col-form-label">Carrosel 3:</label>
                                    <input type="file" name="carrosel3" class="form-control" id="editCarrosel3" placeholder="Escolha uma imagem">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <Input type="submit" class="btn btn-warning" id="edit-menu-btn" value="Salvar" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
        </main>
      <!--inicio Botão de voltar ao topo-->
      <?php 
        //require("../Botaodevoltaraotopo.php");
      ?>
      <!--Fim Botão de voltar ao topo-->  

        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="../javascript/dashboard2.js"></script>
        <script src="javascript/custom.js"></script>
  </body>
</html>
