<!DOCTYPE html>
<html lang="pt-br">
    <?php
        //conexão banco de dados 
        include_once("php/conexao.php");

        //pesquisa todas as informações do usuário
        $result_usuario = "SELECT * FROM usuario WHERE Usuario = '$usuario' ";
        $resultado_usuario = mysqli_query($conn, $result_usuario);

        //salva as informações do usuário em variaveis
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
        <title>Suporte Versão 2</title>
        <!--coloca o icone na aba da tela-->
        <link rel="icon" type="png" href="../../COMUM/img/Icons/Vermelho/imgML13.png">
        <!--CSS-->
        <link href="https://fonts.cdnfonts.com/css/community" rel="stylesheet">
        <link rel="stylesheet" href="css/tudo.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body data-id-user="<?php echo $id_user; ?>">
        <!--menu superior-->
        <?php 
            require "titulo.php"; 
        ?>
        <!-- titulo da página-->
        <div class="suportetitulo">
            Suporte
        </div>
        <!--espaço que o chat ocupa-->
        <div class="suportechat">
            <!--corpo do chat-->
            <div class="chat-container">
                <!-- Parte de Cima com o nome do chat -->
                <div class="chat-header">
                    <span>Chat com o Suporte</span>
                </div>
                <!--mostrador de mensagens do chat-->
                <div class="messages-container" id="messages-container"></div>
                <!-- formulário onde você preenche o texto que vai enviar no chat-->
                <form id="chat-form" class="chat-form">
                    <input type="hidden" id="usuario" value="<?php echo $id_user; ?>">
                    <input type="hidden" id="nome" value="<?php echo $nome_usuario; ?>">
                    <input type="text" id="mensagem" placeholder="Digite sua mensagem">
                    <input type="hidden" id="tipo" value="cliente">
                    <button class="botaosuporte" type="submit">Enviar</button>
                </form>
            </div>
        </div>
        <script>
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
         <!--rodapé-->
        <?php 
            require "rodape.php"; 
        ?>
        <!--Javascript-->
        <script src="js/zoom.js"></script>
        <!--<script src="js/darkmode.js"></script>-->
        <script src="js/suporte.js"></script>
    </body>
</html>