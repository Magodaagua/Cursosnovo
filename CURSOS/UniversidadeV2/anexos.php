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

        //coleta todas as informações do usuário
        $result_usuario = "SELECT * FROM usuario WHERE Usuario = '$usuario' ";
        $resultado_usuario = mysqli_query($conn, $result_usuario);

        if ($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
            $id_user = $row_usuario['ID_usuario'];
            $dep = $row_usuario['Dep'];
            $nome_usuario = $row_usuario['Nome'];
            $abreviacao = $row_usuario['Abreviacao'];
        }

        // Busca os anexos do curso
        $result_anexos = "SELECT * FROM anexos WHERE ID_curso = $ID_curso";
        $resultado_anexos = mysqli_query($conn, $result_anexos);

    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Anexos do Curso</title>
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
 
        <div class="anexosdocurso">
            <h2>Anexos do Curso</h2>
            <?php
                if (mysqli_num_rows($resultado_anexos) > 0) {
                    echo "<ul class='anexosul'>";
                    while($row_anexo = mysqli_fetch_assoc($resultado_anexos)) {
                        echo "<li class='anexosli'><a class='anexoslink' href='" . $row_anexo['caminho_arquivo'] . "' target='_blank'>" . basename($row_anexo['caminho_arquivo']) . "</a></li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>Não há anexos disponíveis para este curso.</p>";
                }
            ?>
        </div>
    
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
    </body>
</html>