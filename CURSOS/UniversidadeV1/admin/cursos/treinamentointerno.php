<!doctype html>
<html lang="pt-br">
    <head>
        <?php
            session_start();
            include_once "../conexao.php";
        ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.101.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Treinamento Interno</title>

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
            <input class="form-control form-control-dark w-100" type="text" name="pesquisa" id="pesquisa" placeholder="Search" aria-label="Search">
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
                        <a href="../logout.php"><button type="button"class="btn btn-primary">Sair da conta</button></a>
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
                            <a class="nav-link active" href="treinamentointerno.php">
                            <span data-feather="file"> (current) </span>
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
                            <a class="nav-link" href="../inicial/inicial.php">
                            <span data-feather="file-text"></span>
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
            </div>
        </div>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="container">
                <div class="row mt-4">
                    <div class="col-lg-12 d-flex justify-content-between align-items-center">
                        <div>
                            <h4>Listar Cursos Internos</h4>
                        </div>
                        <div>
                            <!-- Formulário de seleção de categoria -->
                            <form action="javascript:void(0);" method="POST" id="categoria-form">
                                <label for="Categoria" class="col-form-label">Categoria:</label>
                                <select name="id_categoria" id="id_categoria">
                                    <option value="">Escolha a Categoria</option>
                                    <?php
                                        $result_cat_post = "SELECT * FROM categoria ORDER BY Nome_cat";
                                        $resultado_cat_post = mysqli_query($con, $result_cat_post);
                                        while($row_cat_post = mysqli_fetch_assoc($resultado_cat_post) ) {
                                            echo '<option value="'.$row_cat_post['Nome_cat'].'">'.$row_cat_post['Nome_cat'].'</option>';
                                        }
                                    ?>
                                </select>
                                <input type="submit" value="Pesquisar">
                            </form>
                            <?php
                                if($_SERVER['REQUEST_METHOD']=='POST'){
                                    $id_categoria = $_POST['id_categoria'];
                                    
                                    $result_pesquisar = "SELECT Nome_cat FROM categoria WHERE Nome_cat = '$id_categoria'";
                                    
                                    $resultado_pesquisar = mysqli_query($con, $result_pesquisar);
                                    
                                    while ($row_pesquisar = mysqli_fetch_assoc($resultado_pesquisar)){
                                        echo "Empresa: ".$row_pesquisar['Nome_cat'] . "<br>";
                                    }
                                    
                                }
                            ?>
                        </div>
                        <div>
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#cadInternoModal">
                                Cadastrar
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
                <span id="msgAlerta"></span>
                <div class="row">
                    <div class="col-lg-12">
                        <span class="listar-curso"></span>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="cadInternoModal" tabindex="-1" aria-labelledby="cadInternoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                             <h5 class="modal-title" id="cadInternoModalLabel">Cadastrar Curso Interno</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div> 
                        <div class="modal-body">
                            <form id="cad-interno-form" method="POST" action="" enctype="multipart/form-data">
                                <span id="msgAlertaErroCad"></span>
                                <div class="mb-3">
                                    <label for="Nome" class="col-form-label">Nome:</label>
                                    <input type="text" name="Nome" class="form-control" id="Nome" placeholder="Digite o nome completo">
                                </div>
                                <div class="mb-3">
                                    <label for="Categoria" class="col-form-label">Categoria:</label>
                                    <select name="Categoria" id="Categoria">
                                        <option value="">Escolha a Categoria</option>
                                        <?php
                                        	$result_cat_post = "SELECT * FROM categoria ORDER BY Nome_cat";
                                            $resultado_cat_post = mysqli_query($con, $result_cat_post);
                                            while($row_cat_post = mysqli_fetch_assoc($resultado_cat_post) ) {
                                                echo '<option value="'.$row_cat_post['Nome_cat'].'">'.$row_cat_post['Nome_cat'].'</option>';
                                            }
                                        ?>
                                    </select>
                                    <!--<input type="text" name="Categoria" class="form-control" id="Categoria" placeholder="Digite a Descrição">-->
                                </div>
                                <div class="mb-3">
                                    <label for="Subcategoria" class="col-form-label">Subcategoria:</label>
                                    <input type="text" name="Subcategoria" class="form-control" id="Subcategoria" placeholder="Digite a Subcategoria">
                                </div>
                                <div class="mb-3">
                                    <label for="Descricao" class="col-form-label">Descricao:</label>
                                    <input type="text" name="Descricao" class="form-control" id="Descricao">
                                </div>
                                <div class="mb-3">
                                    <label for="Datadecriacao" class="col-form-label">Data de Criação:</label>
                                    <input type="date" name="Datadecriacao" class="form-control" id="Datadecriacao">
                                </div>
                                <div class="mb-3">
                                    <label for="imagem" class="col-form-label">Imagem:</label>
                                    <input type="file" name="imagem" class="form-control" id="imagem">
                                </div>
                                <div class="mb-3">
                                    <label for="pdf" class="col-form-label">PDF:</label>
                                    <input type="file" name="pdf" class="form-control" id="pdf">
                                </div>
                                <div class="mb-3">
                                    <label for="video" class="col-form-label">Video:</label>
                                    <input type="file" name="video" class="form-control" id="video">
                                </div>
                                <div class="mb-3">
                                    <label for="prova" class="col-form-label">Prova:</label>
                                    <input type="file" name="prova" class="form-control" id="prova">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <Input type="submit" class="btn btn-primary" id="cad-interno-btn" value="Cadastrar" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="visInternoModal" tabindex="-1" aria-labelledby="visInternoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="visInternoModalLabel">Detalhes do Curso Interno</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span id="msgAlertaErroVis"></span>
                            <dl class="row">
                                <dt class="col-sm-3">ID</dt>
                                <dd class="col-sm-9"><span id="visID_curso"></span></dd>

                                <dt class="col-sm-3">Nome</dt>
                                <dd class="col-sm-9"><span id="visNome"></span></dd>

                                <dt class="col-sm-3">Categoria</dt>
                                <dd class="col-sm-9"><span id="visCategoria"></span></dd>

                                <dt class="col-sm-3">Subcategoria</dt>
                                <dd class="col-sm-9"><span id="visSubcategoria"></span></dd>

                                <dt class="col-sm-3">Descrição</dt>
                                <dd class="col-sm-9"><span id="visDescricao"></span></dd>

                                <dt class="col-sm-3">Data de Criação</dt>
                                <dd class="col-sm-9"><span id="visdata"></span></dd><br>

                                <dt class="col-sm-3">Nome da Imagem</dt>
                                <dd class="col-sm-9"><span id="visimagem"></span></dd>

                                <dt class="col-sm-3">Nome do PDF</dt>
                                <dd class="col-sm-9"><span id="vispdf"></span></dd>

                                <dt class="col-sm-3">Nome do Video</dt>
                                <dd class="col-sm-9"><span id="visvideo"></span></dd>

                                <dt class="col-sm-3">Nome da prova</dt>
                                <dd class="col-sm-9"><span id="visprova"></span></dd>

                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editInternoModal" tabindex="-1" aria-labelledby="editInternoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                             <h5 class="modal-title" id="editInternoModalLabel">Editar Empresa Parceira</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div> 
                        <div class="modal-body">
                            <form id="edit-interno-form" method="POST" action="" enctype="multipart/form-data">
                                <span id="msgAlertaErroEdit"></span>
                                <input type="hidden" name="ID_curso" id="editId">
                                <div class="mb-3">
                                    <label for="Nome" class="col-form-label">Nome:</label>
                                    <input type="text" name="Nome" class="form-control" id="editNome" placeholder="Digite o nome completo">
                                </div>
                                <div class="mb-3">
                                    <label for="Categoria" class="col-form-label">Categoria:</label>
                                    <select name="Categoria" id="editCategoria">
                                        <option value="">Escolha a Categoria</option>
                                        <?php
                                        	$result_cat_post = "SELECT * FROM categoria ORDER BY Nome_cat";
                                            $resultado_cat_post = mysqli_query($con, $result_cat_post);
                                            while($row_cat_post = mysqli_fetch_assoc($resultado_cat_post) ) {
                                                echo '<option value="'.$row_cat_post['Nome_cat'].'">'.$row_cat_post['Nome_cat'].'</option>';
                                            }
                                        ?>
                                    </select>
                                    <!--<label for="Categoria" class="col-form-label">Categoria:</label>
                                    <input type="select" name="Categoria" class="form-control" id="editCategoria" placeholder="Digite a Categoria">-->
                                </div>
                                <div class="mb-3">
                                    <label for="Subcategoria" class="col-form-label">Subcategoria:</label>
                                    <input type="text" name="Subcategoria" class="form-control" id="editSubcategoria" placeholder="Digite a Subcategoria">
                                </div>
                                <div class="mb-3">
                                    <label for="Descricao" class="col-form-label">Descrição:</label>
                                    <input type="text" name="Descricao" class="form-control" id="editDescricao" placeholder="Digite a Descrição">
                                </div>
                                <div class="mb-3">
                                    <label for="Datadecriacao" class="col-form-label">Data de criação:</label>
                                    <input type="text" name="Datadecriacao" class="form-control" id="editDatadecriacao" placeholder="Digite o Data de Criação">
                                </div>
                                <div class="mb-3">
                                    <label for="imagem" class="col-form-label">Imagem:</label>
                                    <input type="file" name="imagem" class="form-control" id="editimagem">
                                </div>
                                <div class="mb-3">
                                    <label for="pdf" class="col-form-label">PDF:</label>
                                    <input type="file" name="pdf" class="form-control" id="editpdf">
                                </div>
                                <div class="mb-3">
                                    <label for="video" class="col-form-label">Video:</label>
                                    <input type="file" name="video" class="form-control" id="editvideo">
                                </div>
                                <div class="mb-3">
                                    <label for="prova" class="col-form-label">Prova:</label>
                                    <input type="file" name="prova" class="form-control" id="editprova">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <Input type="submit" class="btn btn-warning" id="edit-externo-btn" value="Salvar" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
        </main>
        <!--inicio Botão de voltar ao topo-->
        <?php 
            require("../Botaodevoltaraotopo.php");
        ?>
        <!--Fim Botão de voltar ao topo-->  

        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="../javascript/dashboard2.js"></script>
        <script src="javascript/custom.js"></script>
    </body>
</html>