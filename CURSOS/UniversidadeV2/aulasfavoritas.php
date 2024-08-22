<!DOCTYPE html>
<html lang="pt-br">
        <!-- Conexão com o banco de dados -->
	<?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        //conexão com o banco de dados
        include_once("php/conexao.php"); 

        //pega os dados passados pela URL
        $ID_curso = isset($_GET['ID_curso']) ? $_GET['ID_curso'] : null;
        $Usuario = isset($_GET['Usuario']) ? $_GET['Usuario'] : null;
        $progresso = isset($_GET['progresso']) ? $_GET['progresso'] : null;

        //echo $ID_curso .'<br>';
        //echo $Usuario .'<br>';
        //echo $progresso .'<br>';

        //coleta todas as informações do usuário
        $result_usuario = "SELECT * FROM usuario WHERE Usuario = '$usuario' ";
        $resultado_usuario = mysqli_query($conn, $result_usuario);

        if ($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
            $id_user = $row_usuario['ID_usuario'];
            $dep = $row_usuario['Dep'];
            $nome_usuario = $row_usuario['Nome'];
            $abreviacao = $row_usuario['Abreviacao'];
        }

        //pega todas as informações do curso
        $result_curso = "SELECT * FROM curso WHERE ID_curso = '$ID_curso'";
        $resultado_curso = mysqli_query($conn, $result_curso);
        while($row_cursos = mysqli_fetch_assoc($resultado_curso)){

            // Consulta para obter as aulas favoritas do usuário no curso especificado
            $query_favoritos = "
            SELECT 
                aul.id AS id_aul, 
                aul.titulo, 
                aul.ordem, 
                mdu.id AS id_mdu, 
                mdu.nome AS nome_mdu,
                fav.informacao AS favorito
            FROM 
                aulas_favoritas AS fav
            INNER JOIN 
                aulas AS aul ON fav.id_aula = aul.id
            INNER JOIN 
                modulos AS mdu ON aul.modulo_id = mdu.id
            WHERE 
                fav.id_cliente = :id_user AND 
                mdu.curso_id = :curso_id AND 
                fav.informacao = 1
            ORDER BY 
                mdu.ordem, aul.ordem ASC
            ";

            $stmt_favoritos = $con->prepare($query_favoritos);
            $stmt_favoritos->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt_favoritos->bindParam(':curso_id', $ID_curso, PDO::PARAM_INT);
            $stmt_favoritos->execute();

    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Aulas Favoritas</title>
        <!--coloca o icone na aba da tela-->
        <link rel="icon" type="png" href="../../COMUM/img/Icons/Vermelho/imgML13.png">
        <!--CSS-->
        <link rel="stylesheet" href="css/tudo.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body data-id-user="<?php echo $id_user; ?>">
        <?php 
            //conexão com o banco de dados
            require "titulo.php"; 
        ?>
        <div class="botaovoltarteste">
            <button onclick="goBack()">
                <img src="../../COMUM/img/cursos/imagens/return.png">
            </button>
        </div>
        <div class="aulasfavoritascorpo">
            <div class="aulasfavoritastitulo">
                Lista com todas as Aulas Favoritas do curso
            </div>
            <div class="listacompletadasaulasfavoritas">
                <?php
                    // Use um loop para exibir os módulos e aulas favoritas
                    if ($stmt_favoritos->rowCount() > 0) {
                        $modulo_anterior = null;

                        while ($row_aula = $stmt_favoritos->fetch(PDO::FETCH_ASSOC)) {
                            extract($row_aula);
                            $titulo = mb_strimwidth($row_aula['titulo'], 0, 100, '...');

                            if ($modulo_anterior !== $id_mdu) {
                                if (!is_null($modulo_anterior)) {
                                    echo "</div>"; // Fecha o contêiner do módulo anterior
                                }
                                // Exibir o módulo
                                echo "<div class='modulo'>
                                        <h5>Nome do módulo: $nome_mdu</h5>
                                        <div class='fundo-transparente'>
                                            <img class='seta' src='../../COMUM/img/cursos/imagens/arrowright.png' width='30' height='30'>
                                            <div class='num-aulas'>Aulas Favoritas</div>
                                        </div>
                                    </div>";
                                echo "<div class='aulas' style='display: none'>";
                            }

                            // Exibir a aula favorita
                            echo "<div class='aula'>
                                    <div class='aula-inner'>
                                        <p class='aula-titulo'>Aulas: $ordem | Título: $titulo | <a class='botaodetalhes' href='visualizar_aula.php?id_usuario=$id_user&id=$id_aul&modulo_id=$id_mdu&curso_id=$ID_curso&ordem=$ordem'>Ver Aula</a></p>
                                    </div>
                                </div>";

                            $modulo_anterior = $id_mdu;
                        }

                        // Fecha o último contêiner das aulas
                        if (!is_null($modulo_anterior)) {
                            echo "</div>";
                        }
                        echo "</div>"; // Fecha o contêiner geral
                    } else {
                        echo "<p style='color: #f00;'>Ainda não favoritou nenhuma aula, favorite para ela aparecer aqui</p>";
                    }
                ?>
            </div>
        </div>
        <?php } ?>
        <!-- javascript -->
        <script>
            function goBack() {
                window.history.back();
            }
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
        <!--<script src="js/darkmode.js"></script>-->
        <script src="js/zoom.js"></script>
        <script src="js/modulos.js"></script>
    </body>
</html>