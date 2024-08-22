<!doctype html>
<html lang="pt-br">
    <head>
        <?php 
            include_once "conexao.php";

            $result_usuario = "SELECT * FROM administrador WHERE email = '$email' ";
            $resultado_usuario = mysqli_query($con, $result_usuario);
            while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
                $row_usuario['ID_admin']."<br>";		
                $row_usuario['senha']."<br>"; 
    
            $id_user = $row_usuario['ID_admin'];
            //$nome = $row_usuario['Nome'];

        ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Dashboard</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/dashboard/">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <!--coloca o icone na aba da tela-->
        <link rel="icon" type="png" href="../img/logo_copi.png">

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

            .chat-container {
                width: 80%; /* Ajuste a largura conforme necessário */
                height: 80%;
                background-color: #fff;
                box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                overflow: hidden;

            }

            .chat-header {
                background-color: #25D366;
                color: #fff;
                padding: 10px;
                text-align: center;
                font-size: 18px 0 0 0;
                border-radius: 10px 10px 0 0; /* Borda superior arredondada */
            }

            .messages-container {
                max-height: 350px;
                overflow-y: auto;
                padding: 10px;
            }

            .chat-form {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px;
                border-top: 1px solid #ddd;
            }

            .chat-form input,
            .chat-form button {
                padding: 8px;
                margin: 5px;
                border: none;
                border-radius: 5px;
            }

            .chat-form input[type="text"] {
                flex-grow: 1;
            }

            .chat-form button {
                background-color: #25D366;
                color: #fff;
                cursor: pointer;
            }

            .chat-form button:hover {
                background-color: #128C7E;
            }

            /* Adicione classes específicas para o suporte e o cliente */
            .message-balloon {
                max-width: 70%;
                margin-bottom: 10px;
                padding: 10px;
                border-radius: 10px;
                clear: both;
            }

            .message-balloon.suporte {
                float: left;
                background-color: #d0e8f7;
            }

            .message-balloon.cliente {
                float: right;
                background-color: #e2e5e7;
            }

            .data {
                font-size: 12px; /* Ajuste o tamanho da fonte conforme necessário */
                color: #777; /* Cor cinza ou outra cor desejada */
                float: left; /* Alinha a data à esquerda */
            }

            .hora {
                font-size: 12px; /* Ajuste o tamanho da fonte conforme necessário */
                color: #777; /* Cor cinza ou outra cor desejada */
                float: right; /* Alinha a hora à direita */
            }

            .table-container {
                max-height: 300px;
                overflow-y: auto;
                border-radius: 10px; /* Borda arredondada */
                background-color: #25D366; /* Fundo verde */
            }

            .table thead th {
                position: sticky;
                top: -1%;
                background-color: #25D366;
                color: #fff; /* Texto branco */
                border-radius: 10px 10px 0 0; /* Borda superior arredondada */
            }

            .table tbody td {
                border-radius: 0 0 10px 10px; /* Borda inferior arredondada */
            }


        </style>

        <!-- Custom styles for this template -->
        <link href="../css/dashboard.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="menu.php">Portal do Administrador</a>
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
                    <a class="nav-link active" href="menu.php">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="parceiros/treinamentoexterno.php">
                    <span data-feather="file"></span>
                    Treinamento Externo
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cursos/treinamentointerno.php">
                    <span data-feather="file"></span>
                    Treinamento Interno
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="usuarios/usuarios.php">
                    <span data-feather="users"></span>
                    Usuários Cadastrados
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categorias/categoria.php">
                    <span data-feather="bar-chart-2"></span>
                    Categorias
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="administrador/administrador.php">
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
                    <a class="nav-link" href="inicial/inicial.php">
                    <span data-feather="file-text"></span>
                    Inicial
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rodape/rodape.php">
                    <span data-feather="file-text"></span>
                    Rodapé
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cliente.php">
                    <span data-feather="file-text"></span>
                    Mensagem
                    </a>
                </li>
                </ul>
            </div>
            </nav>
            <div class="container-fluid">
                <div class="row">
                    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                        <!-- Seu conteúdo de chat existente aqui -->
                        <br>
                        <h1>
                            <center>Chat</center>
                        </h1>
                        <br>
                        <center>
                            <div class="row">
                                <!-- Chat container -->
                                <div class="col-md-8 chat-container">
                                    <div class="chat-header">
                                        <span id="chat-header-text">Chat com o Cliente</span>
                                    </div>
                                    <div class="messages-container" id="messages-container"></div>
                                    <form id="chat-form" class="chat-form">
                                        <input type="hidden" id="usuario" value="">
                                        <input type="hidden" id="nome" value="">
                                        <input type="hidden" id="tipo" value="suporte">
                                        <input type="text" id="mensagem" placeholder="Digite sua mensagem">
                                        <button type="submit">Enviar</button>
                                    </form>
                                </div>
                                <!-- Tabela de clientes -->
                                <div class="col-md-4">
                                    <div style="max-height: 300px; overflow-y: auto;">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Nomes dos Clientes</th>
                                                </tr>
                                            </thead>
                                            <tbody id="clientes-table">
                                                <!-- Aqui serão adicionadas as linhas da tabela com os nomes dos clientes -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </center>
                    </main>
                </div>
            </div>
            <script>
                // Vamos manter a função carregarClientes como antes
                function carregarClientes() {
                    $.ajax({
                        url: 'lista_clientes.php',
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            var clientesTable = $('#clientes-table');
                            clientesTable.empty();

                            $.each(data, function (index, cliente) {
                                clientesTable.append('<tr><td><a href="#" onclick="abrirChat(' + cliente.ID_usuario + ', \'' + cliente.Nome + '\')">' + cliente.Nome + '</a></td></tr>');
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error('Erro na requisição Ajax:', status, error);
                        }
                    });
                }

                $(document).ready(function () {
                    carregarClientes();
                });

                // Função para carregar mensagens do servidor
                function carregarMensagensCliente(idUsuario, nomeCliente) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'exibir_mensagens_admin.php?id_cliente=' + idUsuario + '&nome_cliente=' + nomeCliente, true);
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4) {
                            //console.log('Resposta do servidor:', xhr.responseText);

                            // Verificar se a resposta contém a mensagem "Nenhuma mensagem"
                            if (xhr.responseText.indexOf('Nenhuma mensagem') === -1) {
                                // Atualizar o conteúdo do contêiner de mensagens
                                document.getElementById('messages-container').innerHTML = xhr.responseText;

                                // Role para a última mensagem
                                var messagesContainer = document.getElementById('messages-container');
                                messagesContainer.scrollTop = messagesContainer.scrollHeight;
                            } else {
                                //console.log('Resposta do servidor indica: Nenhuma mensagem.');
                                document.getElementById('messages-container').innerHTML = '<p>Nenhuma mensagem.</p>';
                                // Adicione código adicional se necessário
                            }
                        }
                    };
                    xhr.send();
                }

                // Função para carregar mensagens do cliente em intervalos regulares
                function carregarMensagensAutomaticamente(idUsuario) {
                    // Esta função será chamada recursivamente após um intervalo de 5 segundos
                    function carregar() {
                        // Carregue as mensagens do cliente atual
                        carregarMensagensCliente(idUsuario);

                        // Aguarde 5 segundos antes de chamar a função novamente
                        setTimeout(carregar, 5000);
                    }

                    // Inicie o processo de atualização automática
                    carregar();
                }

                // Adicione um ouvinte de evento para o formulário de chat
                document.getElementById('chat-form').addEventListener('submit', function (e) {
                    e.preventDefault();
                    // Chame a função de envio de mensagem
                    enviarMensagem();
                });

                // Função para enviar mensagem
                function enviarMensagem() {
                    var usuario = document.getElementById('usuario').value;
                    var nome = document.getElementById('nome').value;
                    var mensagem = document.getElementById('mensagem').value;
                    var tipo = document.getElementById('tipo').value;

                    // Adicione a identificação única do cliente à requisição
                    var cliente_id = 'coloqueAquiOIDUnicoDoCliente';  // Substitua pelo ID único do cliente com quem o suporte está interagindo
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'enviar_mensagem_admin.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            // Processar a resposta do servidor, se necessário
                            //console.log('Status do envio de mensagem:', xhr.status);
                            //console.log('Resposta do servidor:', xhr.responseText);

                            // Atualizar mensagens após o envio bem-sucedido, com um pequeno atraso
                            setTimeout(function () {
                                carregarMensagensCliente(usuario);
                            }, 1000); // Atraso de 1 segundo (pode ajustar conforme necessário)
                        }
                    };

                    xhr.send('usuario=' + encodeURIComponent(usuario) + '&nome=' + encodeURIComponent(nome) + '&mensagem=' + encodeURIComponent(mensagem) + '&tipo=' + encodeURIComponent(tipo) + '&cliente_id=' + encodeURIComponent(cliente_id));

                    // Limpar campo de mensagem após envio
                    document.getElementById('mensagem').value = '';
                }

                // Variável global para armazenar o identificador do temporizador
                var timerId;
                // Variável global para armazenar o ID do usuário do cliente atualmente em foco
                var usuarioAtual;

                // Função para abrir o chat com um cliente específico
                function abrirChat(idUsuario, nomeCliente) {

                    // Limpa o temporizador anterior, se existir
                    if (timerId) {
                        clearTimeout(timerId);
                    }

                            // Verifica se o chat atual é o mesmo que está sendo aberto
                    if (idUsuario !== usuarioAtual) {
                        // Atualiza o cabeçalho do chat com o nome do cliente
                        document.getElementById('chat-header-text').innerText = 'Chat com ' + nomeCliente;

                        // Define o ID do cliente para o formulário de envio de mensagens
                        var usuarioInput = document.getElementById('usuario');
                        if (usuarioInput) {
                            usuarioInput.value = idUsuario;
                        }

                        // Atualiza os valores dos campos id_usuario e nome
                        var nomeInput = document.getElementById('nome');
                        if (nomeInput) {
                            nomeInput.value = nomeCliente;
                        }

                        // Armazena o ID do usuário do cliente atual
                        usuarioAtual = idUsuario;

                        // Carrega as mensagens do novo cliente
                        carregarMensagensCliente(idUsuario, nomeCliente);

                        // Inicia o processo de atualização automática
                        carregarMensagensAutomaticamente(idUsuario);
                    }
                }

                // Função para carregar mensagens do cliente em intervalos regulares
                function carregarMensagensAutomaticamente(idUsuario) {
                    // Esta função será chamada recursivamente após um intervalo de 5 segundos
                    function carregar() {
                        // Verifica se o chat atual é o mesmo que está sendo atualizado
                        if (idUsuario === usuarioAtual) {
                            // Carregue as mensagens do cliente atual
                            carregarMensagensCliente(idUsuario);

                            // Aguarde 5 segundos antes de chamar a função novamente
                            timerId = setTimeout(carregar, 5000);
                        }
                    }

                    // Inicie o processo de atualização automática
                    carregar();
                }


                // No final do seu script, inicie o processo de atualização automática
                var usuarioInput = document.getElementById('usuario');
                if (usuarioInput) {
                    var idUsuario = usuarioInput.value;
                    carregarMensagensAutomaticamente(idUsuario);
                }
            </script>


        <!--inicio Botão de voltar ao topo-->
        <?php 
            }
            require("../Botaodevoltaraotopo.php");
        ?>
        <!--Fim Botão de voltar ao topo-->  

        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="javascript/dashboard.js"></script>
    </body>
</html>