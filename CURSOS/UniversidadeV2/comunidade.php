<!DOCTYPE html>
<html lang="pt-br">
    <?php
        //conexao com o banco de dados
        include_once("php/conexao.php");

        //pega a categoria passadas pela url
        $categoria = isset($_GET['Dep']) ? $_GET['Dep'] : null;
        $subcategoria = isset($_GET['subcategoria']) ? $_GET['subcategoria']:null;

        //faz uma busca no banco de dados para voltar todas as informações da categoria
        $result_categoria = "SELECT * FROM categoria WHERE Nome_cat = '$categoria'";
        $resultado_categoria = mysqli_query($conn, $result_categoria);

        //se o resultado da busca feita anteriormente existir vai guardar o id da categoria na variavel $id_categoria_atual
        if ($resultado_categoria) {
            $row_categoria = mysqli_fetch_assoc($resultado_categoria);
            $id_categoria_atual = $row_categoria['id'];
        } else {
            // Trate o erro, se houver algum
            echo "Erro na consulta: " . mysqli_error($conn);
        }

        //pega as informações do usuario e salva nas variaveis
        $result_usuario = "SELECT * FROM usuario WHERE Usuario = '$usuario' ";
        $resultado_usuario = mysqli_query($conn, $result_usuario);

        if ($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
            $id_user = $row_usuario['ID_usuario'];
            $dep = $row_usuario['Dep'];
            $nome_usuario = $row_usuario['Nome'];
            $abreviacao = $row_usuario['Abreviacao'];
        }

    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Nome do site-->
        <title>Comunidade Versão 2</title>
        <!--coloca o icone na aba da tela-->
        <link rel="icon" type="png" href="../../COMUM/img/Icons/Vermelho/imgML13.png">
        <!--CSS-->
        <link rel="stylesheet" href="css/tudo.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body data-id-user="<?php echo $id_user; ?>">
        <!--menu superior-->
        <?php 
            require "titulo.php"; 
        ?>
        <!-- titulo da página -->
        <div class="submenu">
            Seja bem vindo a nossa comunidade
        </div>
        <!-- botões da parte de cima -->
        <div class="comunidadecimapartemeio">
            <div class="comunidadepartecima">
                <div class="criarsala">
                    <button onclick="toggleForm()">Criar uma Sala</button>
                </div>
                <div class="filtrosalamaisrecente">
                    <select name="maisrecentes" id="maisrecentes" onchange="filtrarcomunidade()">
                        <option value="default">Selecione um filtro</option>
                        <?php
                            $result_cat_post = "SELECT * FROM subcategoria WHERE ID_categoria = $id_categoria_atual ORDER BY Nome ";
                            $resultado_cat_post = mysqli_query($conn, $result_cat_post);
    
                            while($row_cat_post = mysqli_fetch_assoc($resultado_cat_post)) {
                                $selected = ($row_cat_post['id'] == $subcategoria) ? 'selected' : '';
                                echo '<option value="'.$row_cat_post['id'].'" ' . $selected . '>'.$row_cat_post['Nome'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        // Recuperar o valor atual do filtro
                        var filtroSelecionado = "<?php echo $subcategoria; ?>";

                        // Selecionar a opção correta com base no filtro atual
                        if (filtroSelecionado) {
                            document.getElementById("maisrecentes").value = filtroSelecionado;
                        }

                        // Adicionar evento onchange ao <select> Nível
                        document.getElementById("maisrecentes").addEventListener("change", filtrarcomunidade);
                    });

                    function filtrarcomunidade() {
                        var filtroSelecionado = document.getElementById("maisrecentes").value;

                        if (filtroSelecionado === 'default') {
                            // Redirecionar para a página removendo o parâmetro de subcategoria
                            const url = `comunidade.php?Dep=<?php echo $categoria ?>`;
                            window.location.href = url;
                        } else {
                            // Redirecionar para a página com o parâmetro de subcategoria selecionado
                            const url = `comunidade.php?Dep=<?php echo $categoria ?>&subcategoria=${filtroSelecionado}`;
                            window.location.href = url;
                        }
                    }

                </script>
                <div class="doisbotoesdocanto">
                    <div class="botaocantoum">
                        <button onclick="limparFiltro()">
                            <input type="hidden" name="categoria" id="categoria" value="<?php echo $dep; ?>">
                            <img class="botaocantoumimg" src="../../COMUM/img/cursos/imagens/reload.png">
                        </button>
                    </div>
                    <div class="botaocantodois">
                        <!--<button>
                            <img class="botaocantodoisimg" src="../../COMUM/img/cursos/imagens/check.png">
                        </button>-->
                    </div>
                </div>
            </div>
        </div>
        <!-- lateral esquerda baixo é onde tem algumas informações-->
        <div class="comunidadepartebaixo">
            <div class="esquerda">
                <div class="esquerdacima">
                    Filtro
                    <ul>
                        <li class="sem-marcador">
                            <img class="esquerdacimaimg1" src="../../COMUM/img/cursos/imagens/balloon.png">&nbsp;
                            Todas as salas
                        </li>
                        <li class="sem-marcador">
                            <img class="esquerdacimaimg2" src="../../COMUM/img/cursos/imagens/star.png">&nbsp;
                            Seguindo
                        </li>
                        <li class="sem-marcador">
                            <img class="esquerdacimaimg3" src="../../COMUM/img/cursos/imagens/blocks.png">&nbsp;
                            Tags
                        </li>
                    </ul>
                </div>
                <div class="esquerdabaixo">
                    Legenda
                    <ul>
                        <li>Software</li>
                        <li>Informática</li>
                        <li>Impressoras</li>
                    </ul>
                </div>
            </div>
            <!-- lateral direita baixo é onde ficam as salas que você pode entrar-->
            <div class="direita">
                <?php
                    //faz uma busca para voltar todas as salas registradas no banco de dados
                    $result_grupos = "SELECT * FROM salas WHERE Categoria = '$id_categoria_atual'";

                    // Se a subcategoria não for nula, adiciona uma cláusula AND à consulta
                    if ($subcategoria != null) {
                        $result_grupos .= " AND Subcategoria = '$subcategoria'";
                    }

                    //acrescenta na busca um filtro de mais novo aparece antes
                    $result_grupos .= " ORDER BY Data_criacao DESC";

                    $resultado_grupos = mysqli_query($conn, $result_grupos);

                    while($row_grupo = mysqli_fetch_assoc($resultado_grupos)) {
                        $id_subcategoria = $row_grupo['Subcategoria'];
                        $result_subcategoria = "SELECT Nome FROM subcategoria WHERE id = '$id_subcategoria'";
                        $resultado_subcategoria = mysqli_query($conn, $result_subcategoria);
                        $row_subcategoria = mysqli_fetch_assoc($resultado_subcategoria);
                        $nome_subcategoria = $row_subcategoria['Nome'];

                        // Definindo a cor com base no id_subcategoria
                        $cor = '';
                        switch($id_subcategoria) {
                            case 1:
                                $cor = 'purple';
                                break;
                            case 2:
                                $cor = 'green';
                                break;
                            case 3:
                                $cor = 'red';
                                break;
                            case 4:
                                $cor = 'blue'; 
                                break;
                            // Adicione mais casos conforme necessário
                        }

                        echo '<div class="sala">';
                            echo '<div class="retangulocimasala">';
                                echo '<div class="nomeabrevisadosala">'.$categoria.'</div>';
                                echo '<div class="nome-sala">' . $row_grupo['Nome_grupo'] . '</div>';
                                echo '<div class="tiposala" style="background-color:'.$cor.';">'.$nome_subcategoria.'</div>';
                                echo '<!--<div class="salamensagens"><img src="../../COMUM/img/cursos/imagens/comment.png">10</div>-->';
                            echo '</div>';
                            
                            $id_grupo = $row_grupo['ID_grupo'];

                            // Verifica se o usuário está inscrito no grupo
                            $query_inscricao = "SELECT * FROM inscricao_grupo WHERE id_cliente = $id_user AND id_grupo = $id_grupo";
                            $resultado_inscricao = mysqli_query($conn, $query_inscricao);

                                echo '<div class="publica">'.$row_grupo['descricao'].'</div>';

                                // Se o usuário já estiver inscrito, mostra o botão de continuar, senão, mostra o botão de entrar
                                if (mysqli_num_rows($resultado_inscricao) > 0) {
                                    echo '<div class="botao_continuar"><a href="salas.php?id_grupo=' . $id_grupo .'&id_user=' . $id_user . '"><button class="continuar">Continuar</button></a></div>';
                                } else {
                                    echo '<div class="botao_continuar"><a class="btn-entrar" href="php/inscrever_grupo.php?id_grupo=' . $id_grupo . '&id_user=' . $id_user . '"><button class="entrar">Entrar</button></a></div>';

                                }
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
        <div class="overlay" onclick="fecharPopUp()"></div>
        <div id="criarSalaForm" class="popup-form">
            <form method="post" action="php/criar_sala.php">
                <label for="nomeSala">Nome da Sala:</label>
                <input type="text" name="nomeSala" required>

                <label for="descricaoSala">Breve descrição:</label>
                <input type="text" name="descricaoSala" required>

                <input type="hidden" name="categoriaSala"  value="<?php echo $id_categoria_atual; ?>">

                <input type="hidden" name="categoria"  value="<?php echo  $categoria; ?>">

                <input type="hidden" name="idusuario"  value="<?php echo $id_user; ?>" >

                <label for="privacidade">Categoria:</label>
                <select name="privacidade" required>
                    <option value="default">Selecione uma categoria</option>
                    <?php
                        $result_cat_post = "SELECT * FROM subcategoria WHERE ID_categoria = $id_categoria_atual ORDER BY Nome ";
                        $resultado_cat_post = mysqli_query($conn, $result_cat_post);

                        while($row_cat_post = mysqli_fetch_assoc($resultado_cat_post)) {
                            $selected = ($row_cat_post['id'] == $subcategoria) ? 'selected' : '';
                            echo '<option value="'.$row_cat_post['id'].'" ' . $selected . '>'.$row_cat_post['Nome'].'</option>';
                        }
                    ?>
                </select>
                <div class="botao_criar"><button type="submit">Criar</button></div>
            </form>
        </div>
        <!-- Adicione abaixo do botão de voltar ao topo -->
        <div class="overlay"></div>
        <div class="overlay" onclick="fecharPopUp()"></div>

        <script>
            function fecharPopUp() {
                var overlay = document.querySelector('.overlay');
                var form = document.getElementById('criarSalaForm');

                if (overlay && form) {
                    overlay.style.display = 'none';
                    form.style.display = 'none';
                }
            }

            function toggleForm() {
                //console.log('toggleForm foi chamada');
                
                var overlay = document.querySelector('.overlay');
                var form = document.getElementById('criarSalaForm');

                //console.log('overlay:', overlay);
                //console.log('form:', form);

                if (!overlay || !form) {
                    console.log('Elementos não encontrados');
                    return;
                }

                overlay.style.display = overlay.style.display === 'none' || overlay.style.display === '' ? 'block' : 'none';
                form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
            }

            document.getElementById('criarSalaForm').addEventListener('submit', function(event) {
                var nomeSala = document.querySelector('input[name="nomeSala"]').value;
                var descricaoSala = document.querySelector('input[name="descricaoSala"]').value;
                var privacidade = document.querySelector('select[name="privacidade"]').value;

                if (nomeSala === '' || descricaoSala === '' || privacidade === 'default') {
                    event.preventDefault(); // Impede o envio do formulário

                    if (nomeSala === '') {
                        alert('Por favor, preencha o nome da sala.');
                    }

                    if (descricaoSala === '') {
                        alert('Por favor, preencha a descrição da sala.');
                    }

                    if (privacidade === 'default') {
                        alert('Por favor, selecione uma categoria.');
                    }
                }
            });
  
            // Recupera o id_user do atributo data do body
            var id_user = $('body').data('id-user');

            var soundPlayedAnexos = false; // Variável para rastrear se o som já foi tocado

            $(document).ready(function() {
                // Adiciona um evento de mouseover ao elemento desejado
                $('#seu-elemento').on('mouseover', function() {
                    showPopupNotificacao();
                });
            });

            setInterval(function() {
                $.ajax({
                    url: 'php/check_messages.php',
                    type: 'POST',
                    data: { id_user: id_user },
                    success: function(data) {
                        let botaoNotificacao = document.getElementById('botao-notificacao').querySelector('img');
                        if (data.trim() === 'true') {
                            botaoNotificacao.src = '../../COMUM/img/cursos/imagens/notification.png';
                            if (!soundPlayedAnexos) {
                                playNotificationSound(); // Tocar o som de notificação
                                soundPlayedAnexos = true; // Marcar que o som foi tocado
                            }
                        } else {
                            botaoNotificacao.src = '../../COMUM/img/cursos/imagens/bell.png';
                            soundPlayedAnexos = false; // Resetar a variável quando não há novas notificações
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Erro na requisição AJAX: ", status, error);
                    }
                });
            }, 5000); // Verifica a cada 5 segundos

        </script>
        <?php 
            require "rodape.php"; 
        ?>
        <!--<script src="js/darkmode.js"></script>-->
        <script src="js/limparfiltrocomunidade.js"></script>
        <script src="js/zoom.js"></script>
    </body>
</html>