<!doctype html>
<html lang="pt-br">
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        include_once("php/conexao.php");

        $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;
        $id_grupo = isset($_GET['id_grupo']) ? $_GET['id_grupo'] : null;

        $result_usuario = "SELECT * FROM usuario WHERE ID_usuario = '$id_user' ";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        while ($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
            $id_user = $row_usuario['ID_usuario'];
            $nome = $row_usuario['Nome'];
            $id_grupo = $_GET['id_grupo'];
            $dep = $row_usuario['Dep'];
            $nome_usuario = $row_usuario['Nome'];
            $abreviacao = $row_usuario['Abreviacao'];

            $result_grupo = "SELECT * FROM salas WHERE ID_grupo = '$id_grupo'";
            $resultado_grupo = mysqli_query($conn, $result_grupo);
            while ($row_grupo = mysqli_fetch_assoc($resultado_grupo)) {
                $id_grupo1 = $row_grupo['ID_grupo'];
                $nome_grupo = $row_grupo['Nome_grupo'];
                $chat_bloqueado = $row_grupo['chat_bloqueado'];
                $id_admin = $row_grupo['id_admin_grupo'];
            }
    ?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <title>Grupo de Estudos - <?php echo $nome_grupo; ?></title>
        <link rel="icon" type="png" href="../../COMUM/img/Icons/Vermelho/imgML13.png">
        <link rel="stylesheet" href="css/tudo.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script>
    </head>

    <body data-id-user="<?php echo $id_user; ?>">
        <?php 
            require "titulo.php"; 
        ?>
        <br>
        <!-- Adicione isso no seu HTML onde você quer que o botão apareça -->
        <div class="botaoencerrarereabrir">
            <?php if ($id_user == $id_admin): ?>
                <button id="toggle-chat-button">
                    <?php echo $chat_bloqueado ? 'Reabrir conversa' : 'Encerrar conversa'; ?>
                </button>
            <?php endif; ?>
        </div>
        <div class="chatsala">
            <div class="chat-container">
                <div class="chat-header">
                    <span>Chat do grupo</span>
                </div>
                <div class="messages-container" id="messages-container"></div>

                <form id="chat-form" class="chat-form" enctype="multipart/form-data">
                    <input type="hidden" id="usuario" value="<?php echo $id_user; ?>">
                    <input type="hidden" id="nome" value="<?php echo $nome; ?>">
                    <input type="hidden" id="id_grupo" value="<?php echo $id_grupo; ?>">

                    <input type="file" id="file-upload" style="display: none;">
                    <div id="upload-container" style="position: relative;">
                        <button type="button" id="upload-button">📎</button>
                        <div id="filePreview" style="display: none;"></div>
                    </div>
                    <input type="text" id="mensagem" placeholder="Digite sua mensagem">
                    <button type="submit" id="send-button">Enviar</button>
                </form>
            </div>
            <div class="participants-container" id="participants-container">
                <div class="chat-header">Membros do Grupo</div>
                <?php
                    // Buscar informações do administrador
                    $query_admin = "SELECT id_admin_grupo FROM salas WHERE ID_grupo = $id_grupo";
                    $result_admin = mysqli_query($conn, $query_admin);
                    $row_admin = mysqli_fetch_assoc($result_admin);
                    $id_admin = $row_admin['id_admin_grupo'];

                    // Buscar o nome do administrador
                    $query_admin_nome = "SELECT Nome FROM usuario WHERE ID_usuario = $id_admin";
                    $result_admin_nome = mysqli_query($conn, $query_admin_nome);
                    $row_admin_nome = mysqli_fetch_assoc($result_admin_nome);
                    $nome_admin = $row_admin_nome['Nome'];

                    echo "<div class='participant-section'><strong>Dono do Grupo</strong><div class='Nomedousuario'>" . $nome_admin . "</div></div><hr>";

                    // Buscar informações dos participantes
                    $query_participantes = "SELECT u.Nome, u.ID_usuario FROM usuario u 
                                            INNER JOIN inscricao_grupo ig ON u.ID_usuario = ig.id_cliente
                                            WHERE ig.id_grupo = $id_grupo AND u.ID_usuario != $id_admin";

                    $result_participantes = mysqli_query($conn, $query_participantes);

                    echo "<div class='participant-section'><strong>Convidados</strong>";
                    if (mysqli_num_rows($result_participantes) > 0) {
                        while ($row_participante = mysqli_fetch_assoc($result_participantes)) {
                            echo "<div class='Nomedousuario'>" . $row_participante['Nome'];
                            if ($id_user == $id_admin) {
                                echo " <button class='remove-user-button' data-user-id='" . $row_participante['ID_usuario'] . "'>
                                <img src='../../COMUM/img/cursos/imagens/kick.png'>
                                </button>";
                            }
                            echo "</div>";
                        }
                    } else {
                        echo "<div>Nenhum participante encontrado.</div>";
                    }
                    echo "</div>";

                    mysqli_close($conn);
                ?>
            </div>
        </div>
        <script>
            function isScrolledToBottom(element) {
                return element.scrollHeight - element.clientHeight <= element.scrollTop + 1;
            }

            $(document).ready(function() {
                $("#mensagem").emojioneArea({
                    pickerPosition: "top",
                    tonesStyle: "bullet",
                    events: {
                        keypress: function (editor, event) {
                            if (event.which == 13) {
                                event.preventDefault();
                                document.getElementById('chat-form').submit();
                            }
                        }
                    }
                });

                $('.remove-user-button').click(function() {
                    var userId = $(this).data('user-id');
                    var confirmation = confirm('Você tem certeza de que deseja remover este usuário do grupo?');

                    if (confirmation) {
                        $.ajax({
                            url: 'php/remove_user.php',
                            method: 'POST',
                            data: {
                                user_id: userId,
                                group_id: '<?php echo $id_grupo; ?>'
                            },
                            success: function() {
                                location.reload();
                            }
                        });
                    }
                });

                var isPlaying = false;

                $('audio, video').on('play', function() {
                    isPlaying = true;
                });

                $('audio, video').on('pause ended', function() {
                    isPlaying = false;
                });

                let chatStatus = '<?php echo $chat_bloqueado ? 'fechado' : 'aberto'; ?>';

                document.getElementById('chat-form').addEventListener('submit', function(e) {
                    e.preventDefault();

                    if (chatStatus === 'fechado') {
                        alert("O chat está encerrado.");
                        return;
                    }

                    var usuario = document.getElementById('usuario').value;
                    var nome = document.getElementById('nome').value;
                    var id_grupo = document.getElementById('id_grupo').value;
                    var mensagem = document.getElementById('mensagem').value;
                    var fileInput = document.getElementById('file-upload');
                    var formData = new FormData();

                    formData.append('usuario', usuario);
                    formData.append('nome', nome);
                    formData.append('id_grupo', id_grupo);
                    formData.append('mensagem', mensagem);

                    if (fileInput.files.length > 0) {
                        formData.append('file', fileInput.files[0]);
                    }

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'php/enviar_mensagem_grupo.php', true);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            if (xhr.responseText == 'removido') {
                                window.location.href = 'comunidade.php?Usuario=' + encodeURIComponent('<?php echo $nome_usuario; ?>') + '&Dep=' + encodeURIComponent('<?php echo $dep; ?>');
                            } else {
                                console.log(xhr.responseText);
                                carregarMensagens();
                            }
                        }
                    };
                    xhr.send(formData);

                    // Limpa o campo de texto do plugin emojioneArea
                    $("#mensagem").data("emojioneArea").setText('');
                    fileInput.value = '';

                    var messagesContainer = document.getElementById('messages-container');
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                });

                document.getElementById('upload-button').addEventListener('click', function() {
                    document.getElementById('file-upload').click();
                });

                $('#toggle-chat-button').click(function() {
                    var id_grupo = <?php echo $id_grupo; ?>;
                    var acao = chatStatus === 'fechado' ? 'reabrir' : 'encerrar';

                    $.ajax({
                        url: 'php/toggle_chat.php',
                        method: 'POST',
                        data: {
                            acao: acao,
                            id_grupo: id_grupo
                        },
                        success: function(response) {
                            if (response === 'fechado') {
                                chatStatus = 'fechado';
                                $('#toggle-chat-button').text('Reabrir conversa');
                                // Enviar mensagem de "Chat encerrado"
                                var formData = new FormData();
                                formData.append('usuario', '<?php echo $id_user; ?>');
                                formData.append('nome', '<?php echo $nome; ?>');
                                formData.append('id_grupo', '<?php echo $id_grupo; ?>');
                                formData.append('mensagem', 'Chat encerrado');
                                var xhrMessage = new XMLHttpRequest();
                                xhrMessage.open('POST', 'php/enviar_mensagem_grupo.php', true);
                                xhrMessage.send(formData);
                            } else if (response === 'aberto') {
                                chatStatus = 'aberto';
                                $('#toggle-chat-button').text('Encerrar conversa');
                                // Enviar mensagem de "Chat reaberto"
                                var formData = new FormData();
                                formData.append('usuario', '<?php echo $id_user; ?>');
                                formData.append('nome', '<?php echo $nome; ?>');
                                formData.append('id_grupo', '<?php echo $id_grupo; ?>');
                                formData.append('mensagem', 'Chat reaberto');
                                var xhrMessage = new XMLHttpRequest();
                                xhrMessage.open('POST', 'php/enviar_mensagem_grupo.php', true);
                                xhrMessage.send(formData);
                            } else {
                                alert('Erro ao atualizar o estado do chat.');
                            }
                        },
                        error: function() {
                            alert('Erro ao comunicar com o servidor.');
                        }
                    });
                });

                var scrolledToBottom = true;

                function isScrolledToBottom(element) {
                    return element.scrollHeight - element.clientHeight <= element.scrollTop + 1;
                }

                document.getElementById('messages-container').addEventListener('scroll', function() {
                    scrolledToBottom = isScrolledToBottom(this);
                });

                function carregarMensagens(id_grupo) {
                    var messagesContainer = document.getElementById('messages-container');
                    var shouldScrollToBottom = isScrolledToBottom(messagesContainer);

                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'php/exibir_mensagens_grupo.php?id_grupo=' + '<?php echo $id_grupo1; ?>&id_user=' + '<?php echo $id_user; ?>', true);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            document.getElementById('messages-container').innerHTML = xhr.responseText;

                            if (shouldScrollToBottom) {
                                messagesContainer.scrollTop = messagesContainer.scrollHeight;
                            }
                        }
                    };
                    xhr.send();
                }

                // Quando um arquivo é selecionado
                $('#file-upload').on('change', function() {
                    if (this.files.length === 0) {
                        return; // Nenhum arquivo selecionado, então retorne cedo
                    }
                    var file = this.files[0];
                    var reader = new FileReader();

                    // Quando o arquivo é lido
                    reader.onload = function(e) {
                        var fileType = file["type"];
                        var validImageTypes = ["image/gif", "image/jpeg", "image/png"];

                        // Se o arquivo for uma imagem, exiba a imagem
                        if ($.inArray(fileType, validImageTypes) > 0) {
                            $('#filePreview').html('<img src="' + e.target.result + '" style="max-width: 200px;">');
                        } else {
                            // Caso contrário, exiba o nome do arquivo
                            var fileName = file.name;
                            if (fileName.length > 20) {
                                fileName = fileName.substring(0, 20) + '...'; // Limita o nome do arquivo a 20 caracteres
                            }
                            $('#filePreview').html(fileName);
                        }

                        // Mostre o pop-up
                        $('#filePreview').show();
                    };

                    // Leia o arquivo
                    reader.readAsDataURL(file);
                });

                // Quando o formulário é enviado
                $('#chat-form').on('submit', function() {
                    // Esconda o pop-up
                    $('#filePreview').hide();
                });

                // Quando a tecla Enter é pressionada
                $('#mensagem').on('keydown', function(e) {
                    if (e.keyCode == 13) {
                        // Envie o formulário
                        $('#chat-form').submit();
                    }
                });

                function checkUserRemoval() {
                    $.ajax({
                        url: 'php/check_removal.php',
                        method: 'POST',
                        data: {
                            user_id: '<?php echo $id_user; ?>',
                            group_id: '<?php echo $id_grupo; ?>'
                        },
                        success: function(response) {
                            if (response === 'removido') {
                                window.location.href = 'comunidade.php?Usuario=' + encodeURIComponent('<?php echo $nome_usuario; ?>') + '&Dep=' + encodeURIComponent('<?php echo $dep; ?>');
                            }
                        }
                    });
                }

                $(document).ready(function() {
                    carregarMensagens('<?php echo $id_grupo1; ?>');
                    setInterval(function() {
                        if (!isPlaying && scrolledToBottom) {
                            carregarMensagens('<?php echo $id_grupo1; ?>');
                        }
                        checkUserRemoval();
                    }, 5000);
                });
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
            }
            require "rodape.php"; 
        ?>
        <script src="js/zoom.js"></script>
    </body>
</html>
