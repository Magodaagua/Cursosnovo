// Declaração de variáveis globais
var id_contato_selecionado = null;
var chatAberto = false;
var ultimaDataHora = '0000-00-00 00:00:00';
let intervaloAtualizacaoContatos;
let tipoSelecionado = 'recentes'; // Variável para armazenar o tipo selecionado (recentes ou todos)

// Função para carregar contatos em looping
function iniciarLoopDeAtualizacao(id_user) {
    pararLoopDeAtualizacao(); // Parar qualquer loop anterior
    intervaloAtualizacaoContatos = setInterval(function() {
        carregarContatos(id_user, tipoSelecionado); // Usa o tipoSelecionado atualizado
    }, 5000); // Atualiza a cada 5 segundos
}

// Função para parar o loop de atualização
function pararLoopDeAtualizacao() {
    if (intervaloAtualizacaoContatos) {
        clearInterval(intervaloAtualizacaoContatos);
    }
}

// Função para alternar a exibição do chat
window.toggleChat = function() {
    $('#containerFormChat').toggle();
    tipoSelecionado = 'recentes'; // Define o tipo como 'recentes' ao abrir o chat
    carregarContatos($('body').data('id-user'), tipoSelecionado);
    iniciarLoopDeAtualizacao($('body').data('id-user')); // Inicia o loop ao abrir o chat

    const userId = $('body').data('id-user');
    let statusAtual = $('body').data('status-online');
    let novoStatus = statusAtual === 1 ? 0 : 1;

    $.ajax({
        url: 'php/funcoes.php',
        type: 'POST',
        data: {
            id_usuario: userId,
            status: novoStatus
        },
        success: function(response) {
            const data = JSON.parse(response);
            if (data.success) {
                $('body').data('status-online', novoStatus);
                console.log("Status atualizado com sucesso!");
            } else {
                console.error("Erro ao atualizar o status.");
            }
        },
        error: function() {
            console.error("Erro ao atualizar o status: Not Found");
        }
    });
}

// Certifique-se de parar o loop quando fechar o chat ou sair da aba de contatos
$(window).on('beforeunload', function(){
    pararLoopDeAtualizacao();
});

window.selecionarOpcao = function(opcao) {
    $('#opcaoesquerdalistacontatos').removeClass('selected');
    $('#opcaodireitalistacontatos').removeClass('selected');
    $('#' + opcao).addClass('selected');

    if (opcao === 'opcaoesquerdalistacontatos') {
        tipoSelecionado = 'recentes';
    } else if (opcao === 'opcaodireitalistacontatos') {
        tipoSelecionado = 'todos';
    }

    carregarContatos($('body').data('id-user'), tipoSelecionado); // Carrega os contatos do tipo selecionado
    iniciarLoopDeAtualizacao($('body').data('id-user')); // Reinicia o loop com o novo tipo
};

// Funções utilitárias
function fecharlistacontato() {
    document.getElementById('containerFormChat').style.display = 'none';

    // Pega o ID do usuário e o status atual
    const userId = $('body').data('id-user');
    let novoStatus = 0; // Sempre vai fechar e deixar o usuário offline

    // Envia a atualização do status via AJAX
    $.ajax({
        url: 'php/funcoes.php',
        type: 'POST',
        data: {
            id_usuario: userId,
            status: novoStatus
        },
        success: function(response) {
            const data = JSON.parse(response);
            if (data.success) {
                $('body').data('status-online', novoStatus);
                console.log("Status atualizado para offline com sucesso!");
                pararLoopDeAtualizacao(); // Para o loop de atualização de contatos
            } else {
                console.error("Erro ao atualizar o status.");
            }
        },
        error: function() {
            console.error("Erro ao atualizar o status: Not Found");
        }
    });
}

function ocultarLinha() {
    document.getElementById('menulistacontatos').style.display = 'none';
}

function voltarParaContatos() {
    document.getElementById('botaoVoltar').style.display = 'none';
    document.getElementById('menulistacontatos').style.display = 'block';
    document.getElementById('chatArea').style.display = 'none';
    document.getElementById('listaContatos').style.display = 'block';
}

function carregarMensagens(id_contato, id_user) {
    ocultarLinha();
    document.getElementById('botaoVoltar').style.display = 'block';

    $.ajax({
        url: 'php/carregar_mensagens.php',
        type: 'POST',
        data: { id_contato: id_contato, id_user: id_user, ultimaDataHora: ultimaDataHora },
        dataType: 'json',
        success: function(response) {
            console.log("Resposta completa do servidor: ", response);
            if (response.error) {
                console.error("Erro retornado pelo servidor: ", response.error);
                $('#mensagens').html('<p>' + response.error + '</p>');
                return;
            }

            if (!response.mensagens.length && ultimaDataHora === '0000-00-00 00:00:00') {
                console.log("Não tem nada aqui");
                $('#mensagens').html('<p>Não tem nada aqui</p>');
                return;
            }

            var mensagensDiv = $('#mensagens');
            
            response.mensagens.forEach(function(mensagem) {
                var isUserMessage = String(mensagem.id_user_envio) === String(id_user);
                var mensagemHtml = `
                    <div class="mensagem ${isUserMessage ? 'mensagem-user' : 'mensagem-contato'}">
                        <div class="conteudo_mensagem">
                            ${mensagem.arquivo ? getArquivoHtml(mensagem.arquivo) : ''}
                            <div class="mensagem-texto">${mensagem.mensagem}</div>
                        </div>
                        <span class="mensagem-data">${new Date(mensagem.data_hora).toLocaleString('pt-BR', {
                            day: '2-digit', 
                            month: '2-digit', 
                            year: 'numeric', 
                            hour: '2-digit', 
                            minute: '2-digit'
                        })}</span>
                    </div>
                `;
                mensagensDiv.append(mensagemHtml);
            });

            mensagensDiv.scrollTop(mensagensDiv.prop("scrollHeight"));

            console.log("Mensagens carregadas com sucesso.");

            if (response.ultimaDataHora) {
                atualizarUltimaDataHora(response.ultimaDataHora);
            }
        },
        error: function(xhr, status, error) {
            console.error("Erro na requisição AJAX: ", status, error);
        }
    });
}

function enviarMensagem() {
    var id_user = $('body').data('id-user');
    var mensagem = $("#mensagemtexto").data("emojioneArea").getText(); // Pegue o texto do emojioneArea
    var file = $('#fileupload')[0].files[0];
    console.log("Enviando mensagem: ", mensagem); // Log para depuração
    console.log("Enviando arquivo: ", file); // Log para depuração
    var formData = new FormData();
    formData.append('id_contato', id_contato_selecionado);
    formData.append('id_user', id_user);
    formData.append('mensagem', mensagem);
    formData.append('file', file);

    $.ajax({
        url: 'php/enviar_mensagem_chat.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log("Resposta do servidor: ", response); // Log para depuração
            var emojioneAreaInstance = $("#mensagemtexto").emojioneArea();
            emojioneAreaInstance[0].emojioneArea.setText(''); // Limpa o campo de texto
            $('#mensagemtexto').val(''); // Limpa o campo de texto
            $('#fileupload').val(''); // Limpa o campo de arquivo
            $('#filePreview').hide().html(''); // Oculta a pré-visualização do arquivo, se houver
            carregarMensagens(id_contato_selecionado, id_user);
            setTimeout(function() {
                $('#mensagens').scrollTop($('#mensagens')[0].scrollHeight);
            }, 100);
        },
        error: function(xhr, status, error) {
            console.error("Erro na requisição AJAX: ", status, error);
        }
    });
}

function getArquivoHtml(arquivo) {
    var extensao = arquivo.split('.').pop().toLowerCase();
    var html = '';

    if (['jpg', 'jpeg', 'png', 'gif'].includes(extensao)) {
        html = `<img src="${arquivo}" alt="Imagem enviada" />`;
    } else if (['mp4', 'mkv'].includes(extensao)) {
        html = `<video controls><source src="${arquivo}" type="video/${extensao}"></video>`;
    } else if (['mp3', 'wav'].includes(extensao)) {
        html = `<audio controls><source src="${arquivo}" type="audio/${extensao}"></audio>`;
    } else {
        html = `<a href="${arquivo}">${arquivo.split('/').pop()}</a>`;
    }

    return html;
}

function verificarNovasMensagens(id_user) {
    $.ajax({
        url: 'php/verificar_novas_mensagens.php',
        type: 'POST',
        data: { id_user: id_user },
        dataType: 'json',
        success: function(response) {
            if (response.haNovasMensagens) {
                response.novasMensagens.forEach(function(contato) {
                    $('#bolinha-' + contato.id_contato).css("display", "block");
                });
                carregarContatos(id_user, tipoSelecionado); // Atualize para respeitar o tipo selecionado
            }
        },
        error: function(xhr, status, error) {
            console.error("Erro na requisição AJAX: ", status, error);
        }
    });
}

function atualizarUltimaDataHora(dataHora) {
    ultimaDataHora = dataHora;
}

// Fazendo as funções acessíveis globalmente, se necessário
window.enviarMensagem = enviarMensagem;

// Inicialização do script quando o DOM estiver pronto
$(document).ready(function() {
    var id_user = $('body').data('id-user');
    var audio = new Audio('../../../COPIZAP/SITE/audio/vetor.mp3');
    audio.loop = true;
    var audioVideoClicked = false;

    // Inicializa o loop de atualização dos contatos ao carregar a página
    iniciarLoopDeAtualizacao(id_user); // Usa o tipo selecionado, que por padrão é 'recentes'

    // Inicialize o emojioneArea e adicione o evento keydown após a inicialização
    var emojioneArea = $("#mensagemtexto").emojioneArea({
        events: {
            ready: function() {
                // Enviar mensagem ao pressionar Enter
                this.editor.on('keydown', function(e) {
                    if (e.which === 13 && !e.shiftKey) {
                        e.preventDefault();
                        enviarMensagem();
                    }
                });
            }
        }
    });

    window.carregarContatos = function(id_user, tipo) {
        $.ajax({
            url: 'php/carregar_contatos.php',
            type: 'POST',
            data: { id_user: id_user, tipo: tipo, _: new Date().getTime() },
            success: function(response) {
                try {
                    var parsedResponse = typeof response === 'string' ? JSON.parse(response) : response;
                    if (parsedResponse.error) {
                        console.error("Erro retornado pelo servidor:", parsedResponse.error);
                    } else {
                        var listaContatos = $('#listaContatos');
                        listaContatos.html('');
    
                        if (parsedResponse.contatos && parsedResponse.contatos.length > 0) {
                            parsedResponse.contatos.forEach(function(contato) {
                                var ultimaInteracaoHtml = contato.ultima_interacao ? `<div class="contato_ultima_mensagem">${contato.ultima_interacao}</div>` : '';
                                var ultimaMensagemHtml = contato.ultima_mensagem ? '<div class="contato_ultima_mensagem">' + contato.ultima_mensagem.substring(0, 150) + '</div>' : '';
    
                                // Verifica o status_online e define a cor da bolinha
                                var corBolinha = contato.status_online == '1' ? 'green' : 'red';

                                var contatoHtml = `
                                    <div class="contato" data-id-contato="${contato.id}">
                                        <div class="contatoimagem" style="position: relative;">
                                            <img src="../../COMUM/img/Funcionarios/${contato.imagem}" alt="Imagem do contato">
                                            <div class="status-indicator" style="background-color: ${corBolinha}; position: absolute; bottom: 0; right: 0; width: 10px; height: 10px; border-radius: 50%;"></div>
                                        </div>
                                        <div class="contato_info">
                                            <div class="juntadonamesmalinha">
                                                <div class="contato_nome">${contato.nome}</div> -> 
                                                <div class="contato_dep">${contato.departamento}</div>
                                            </div>
                                            ${ultimaMensagemHtml}
                                            <div class="partedebaixo">
                                                ${ultimaInteracaoHtml}
                                            </div>
                                        </div>
                                    </div>
                                `;
                                listaContatos.append(contatoHtml);
                            });
    
                            $('.contato').on('click', function() {
                                $('.contato').removeClass('contato-selecionado');
                                $(this).addClass('contato-selecionado');
                                id_contato_selecionado = $(this).data('id-contato');

                                ultimaDataHora = '0000-00-00 00:00:00';
    
                                var foto_contato = $(this).find('.contatoimagem img').attr('src');
                                var nome_contato = $(this).find('.contato_nome').text();
                                var dep_contato = $(this).find('.contato_dep').text();
    
                                $('#contatoImagem').attr('src', foto_contato);
                                $('#contatoNome').text(nome_contato);
                                $('#contatoDepartamento').text(dep_contato);
    
                                $('#listaContatos').hide();
                                $('#chatArea').show();
                                $('#mensagens').html('');
                                carregarMensagens(id_contato_selecionado, id_user);
                            });
                        } else {
                            listaContatos.html('<p>Nenhum contato encontrado.</p>');
                        }
                    }
                } catch (e) {
                    console.error("Erro ao analisar a resposta JSON:", e);
                    console.error("Resposta do servidor:", response);
                    $('#listaContatos').html('<p>Erro ao carregar os contatos. Tente novamente mais tarde.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error("Erro na requisição AJAX: ", status, error);
            }
        });
    };
    
    carregarContatos(id_user, 'recentes');    
    
    // Enviar mensagem ao pressionar Enter
    $('#mensagemtexto').on('keydown', function(e) {
        if (e.which === 13 && !e.shiftKey) {
            e.preventDefault();
            enviarMensagem();
        }
    });
    
    // Mostrar pré-visualização do arquivo selecionado
    document.getElementById('fileupload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const filePreview = document.getElementById('filePreview');
        const previewImage = document.getElementById('previewImage');
        const fileName = document.getElementById('fileName');
    
        if (file) {
            const fileType = file.type;
    
            // Verifica se o arquivo é uma imagem
            if (fileType.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (previewImage) {
                        previewImage.src = e.target.result;
                        previewImage.style.display = 'block';
                    }
                    if (fileName) {
                        fileName.style.display = 'none';
                    }
                };
                reader.readAsDataURL(file);
            } else {
                if (previewImage) {
                    previewImage.style.display = 'none';
                }
                if (fileName) {
                    fileName.textContent = file.name;
                    fileName.style.display = 'block';
                }
            }
    
            if (filePreview) {
                filePreview.style.display = 'block';
            }
        }
    });
    
    // Fechar o preview
    document.getElementById('fecharPreview').addEventListener('click', function() {
        document.getElementById('fileupload').value = '';
        document.getElementById('filePreview').style.display = 'none';
        document.getElementById('previewImage').style.display = 'none';
        document.getElementById('fileName').style.display = 'none';
    });
    
    $('#btnAumentarVolume').on('click', function() {
        if (!audioVideoClicked) {
            audio.play();
            audioVideoClicked = true;
            $(this).hide();
        }
    });

    setInterval(function() {
        verificarNovasMensagens(id_user);
    }, 5000);
});

// Atualize o status para offline ao fechar a aba ou navegador
$(window).on('beforeunload', function() {
    // Pega o ID do usuário
    const userId = $('body').data('id-user');

    // Envia a atualização do status via AJAX
    navigator.sendBeacon('php/funcoes.php', new URLSearchParams({
        id_usuario: userId,
        status: 0 // Define o status como offline
    }));

    // Para o loop de atualização de contatos
    pararLoopDeAtualizacao();
});
