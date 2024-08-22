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

var id_user = $('body').data('id-user');

setInterval(function() {
    $.ajax({
        url: 'php/check_messages.php',
        type: 'POST',
        data: { id_user: id_user },
        success: function(data) {
            let botaoNotificacao = document.getElementById('botao-notificacao').querySelector('img');
            if (data.trim() === 'true') {
                botaoNotificacao.src = '../../COMUM/img/cursos/imagens/notification.png';
            } else {
                botaoNotificacao.src = '../../COMUM/img/cursos/imagens/bell.png';
            }
        },
        error: function(xhr, status, error) {
            console.error("Erro na requisição AJAX: ", status, error);
        }
    });
}, 5000);