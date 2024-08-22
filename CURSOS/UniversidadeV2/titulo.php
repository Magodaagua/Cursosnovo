<!--Menu Superior-->
<div class="menusuperior">
    <!--Titulo Copimaq-->
    <div class="titulocopimaq">
        Copimaq
    </div>
    <!-- Opções do meio do menu HOME, PORTAL COPIMAQ, CURSOS... -->
    <div class="opcoestitulo">
        <a href="menu.php">HOME</a>&nbsp;&nbsp;
        <a href="../../PORTAL/php/pages/home.php?Usuario=<?php echo $usuario;?>">PORTAL COPIMAQ</a>&nbsp;&nbsp;
        <a href="curso.php?Usuario=<?php echo $usuario;?>&Dep=<?php echo $dep;?>">CURSOS</a>&nbsp;&nbsp;
        <a href="comunidade.php?Usuario=<?php echo $usuario;?>&Dep=<?php echo $dep;?>">COMUNIDADE</a>&nbsp;&nbsp;
        <a href="suporte.php?Usuario=<?php echo $usuario;?>">CENTRAL DE AJUDA</a>&nbsp;&nbsp;
    </div>
    <!-- OPções da lateral direita ZOOM, MODO ESCURO...-->
    <div class="maisopcoes">
        <!-- Contêiner para o botão e o popup -->
        <div id="notificacao-container" onmouseenter="showPopupNotificacao()" onmouseleave="hidePopupNotificacao()">
            <!-- Botão de notificação -->
            <button id="botao-notificacao">
                <img src="../../COMUM/img/cursos/imagens/bell.png">
            </button>

            <!-- Popup de notificações -->
            <div id="popup-notificacao" class="popup-notificacao" style="display: none;">
                <div class="popup-content"></div>
            </div>
        </div>
        <button id="botao-zoom">
            <img src="../../COMUM/img/Icons/CinzaMedio/fullScreen.png">
        </button>
        <!--<button id="botao-modo-escuro">
            <img id="icone-modo-escuro" src="../../COMUM/img/cursos/imagens/moon.png" alt="Lua">
        </button>-->
        <button class="nome_abreviado" id="user-info" onmouseenter="togglePopup(document.getElementById('popup'))" onmouseleave="hidePopup(document.getElementById('popup'))">
            <?php echo $abreviacao; ?>
        </button>
    </div>
</div>

<!-- Popup de notificações -->
<!--<div id="popup-notificacao" class="popup-notificacao" style="display: none;">
    <div class="popup-content"></div>
</div>-->

<!-- Popup de opções do usuário -->
<div class="popupContaUser" id="popup" onmouseenter="keepPopup()" onmouseleave="hidePopup(this)">
    <div class="divUlPopupContaUser">
        <ul>
            <li>
                <a href="../../PORTAL/php/pages/meusDados.php">
                    Meus Dados
                </a>
            </li>
            <li>
                <a href="certificadoscopimaq.php?Usuario=<?php echo $usuario;?>">
                    Meus certificados
                </a>
            </li>
            <!--<li><a href="../COMUM/php/alterarSenha-BE.php">Mudar senha</a></li>-->
            <li>
                <a href="../../COMUM/php/logout.php">
                    Sair
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- Adicionar a tag de áudio -->
<audio id="notification-sound" src="../../COMUM/sounds/notification/MicrosoftTeamsMessageSoundNotification.mp3" preload="auto"></audio>

<script>
    let popupAberto = false;
    let popupTimeout;

    // Função para exibir ou ocultar um popup
    function togglePopup(popup) {
        if (!popupAberto) {
            clearTimeout(popupTimeout);
            popup.style.display = 'block';
            popupAberto = true;
        }
    }

    // Função para ocultar um popup
    function hidePopup(popup) {
        if (popupAberto) {
            popupTimeout = setTimeout(function() {
                popup.style.display = 'none';
                popupAberto = false;
            }, 200);
        }
    }

    // Função para manter um popup aberto enquanto o mouse estiver sobre ele
    function keepPopup() {
        clearTimeout(popupTimeout);
    }

    function playNotificationSound() {
        var notificationSound = document.getElementById('notification-sound');
        if (notificationSound) {
            notificationSound.play().catch(function(error) {
                console.error("Erro ao reproduzir o som de notificação: ", error);
            });
        }
    }

    let soundPlayed = false; // Variável para rastrear se o som já foi tocado

    // Função para exibir o popup
    function showPopupNotificacao() {
        $.ajax({
            url: 'php/get_notifications.php',
            type: 'POST',
            data: { id_user: id_user },
            dataType: 'json',
            success: function(data) {
                var popupContent = '';
                var newNotification = false; // Variável para verificar se há nova notificação
                if (data.length > 0) {
                    data.forEach(function(notificacao) {
                        var fotoSrc;
                        var mensagemTexto = notificacao.mensagem ? notificacao.mensagem : 'Imagem recebida';
                        if (notificacao.Evento) {
                            // Esta é uma notificação de evento
                            fotoSrc = notificacao.Arquivo ? '../../COMUM/img/capaEvento/' + notificacao.Arquivo : '../../COMUM/img/capaEvento/default-event.png';
                            popupContent += `
                                <a href="../../COPIZAP/SITE/menu.php?id_user=${id_user}">
                                    <div class="notificacao-item">
                                        <img class="notificacao-foto" src="${fotoSrc}" alt="Foto do evento ${notificacao.Evento}">
                                        <div class="notificacao-info">
                                            <div class="notificacao-nome">${notificacao.Evento}</div>
                                            <div class="notificacao-mensagem">${notificacao.Descricao}</div>
                                            <div class="notificacao-data">${notificacao.DataEvento}</div>
                                        </div>
                                    </div>
                                </a>
                            `;
                        } else if (notificacao.Titulo) {
                            // Esta é uma notificação de comunicado
                            fotoSrc = notificacao.Arquivo ? '../../COMUM/img/Comunicados/' + notificacao.Arquivo : '../../COMUM/img/Comunicados/default-comunicado.png';
                            popupContent += `
                                <a href="../../COPIZAP/SITE/menu.php?id_user=${id_user}">
                                    <div class="notificacao-item">
                                        <img class="notificacao-foto" src="${fotoSrc}" alt="Foto do comunicado ${notificacao.Nome}">
                                        <div class="notificacao-info">
                                            <div class="notificacao-nome">${notificacao.Nome}</div>
                                            <div class="notificacao-mensagem">${notificacao.Titulo}</div>
                                            <div class="notificacao-data">${notificacao.DataPublicado}</div>
                                        </div>
                                    </div>
                                </a>
                            `;
                        } else if (notificacao.Admissao) {
                            // Esta é uma notificação de novo funcionário
                            fotoSrc = notificacao.FotoPerfil ? '../../COMUM/img/Funcionarios/' + notificacao.FotoPerfil : '../../COMUM/img/Funcionarios/default-profile.png';
                            popupContent += `
                                <a href="../../COPIZAP/SITE/menu.php?id_user=${id_user}">
                                    <div class="notificacao-item">
                                        <img class="notificacao-foto" src="${fotoSrc}" alt="Foto de ${notificacao.Nome}">
                                        <div class="notificacao-info">
                                            <div class="notificacao-nome">${notificacao.Nome}</div>
                                            <div class="notificacao-mensagem">${notificacao.mensagem}</div>
                                            <div class="notificacao-data">${notificacao.data_hora}</div>
                                        </div>
                                    </div>
                                </a>
                            `;
                        } else {
                            // Esta é uma notificação de mensagem
                            fotoSrc = notificacao.FotoPerfil ? '../../COMUM/img/Funcionarios/' + notificacao.FotoPerfil : '../../COMUM/img/Funcionarios/default-profile.png';
                            popupContent += `
                                <a href="../../COPIZAP/SITE/menu.php?id_user=${id_user}">
                                    <div class="notificacao-item">
                                        <img class="notificacao-foto" src="${fotoSrc}" alt="Foto de ${notificacao.Nome}">
                                        <div class="notificacao-info">
                                            <div class="notificacao-nome">${notificacao.Nome}</div>
                                            <div class="notificacao-mensagem">${mensagemTexto}</div>
                                            <div class="notificacao-data">${notificacao.data_hora}</div>
                                        </div>
                                    </div>
                                </a>
                            `;
                        }
                        if (notificacao.nova) {
                            newNotification = true; // Marcar se há uma nova notificação
                        }
                    });

                if (newNotification && !soundPlayed) {
                        playNotificationSound(); // Tocar som de notificação
                        soundPlayed = true; // Marcar que o som foi tocado
                    } else if (!newNotification) {
                        soundPlayed = false; // Resetar a variável quando não há novas notificações
                    }
                } else {
                    popupContent = '<div class="notificacao-mensagem">Nenhuma notificação encontrada</div>';
                }
                $('#popup-notificacao .popup-content').html(popupContent);
                $('#popup-notificacao').show();
            },
            error: function(xhr, status, error) {
                console.error("Erro na requisição AJAX: ", status, error);
                console.error("Resposta completa:", xhr.responseText);
            }
        });
    }

    // Função para ocultar o popup
    function hidePopupNotificacao() {
        $('#popup-notificacao').hide();
    }
</script>
