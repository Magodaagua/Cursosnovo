<!-- chat_lateral.php -->
<div id="containerFormChat">
    <div class="conteudoChat" id="conteudoChat">
        <!-- Colocar uma barra embaixo -->
        <div class="topolistacontatos">
            <!-- Colocar imagem do usuário na lateral esquerda -->
            <div class="imagemtopolistacontatos">
                <img src="../../COMUM/img/Funcionarios/<?php echo $row_usuario['FotoPerfil']; ?>">
            </div>
            <!-- Mensagens -->
            <div class="topomensagemlistacontatos">
                Mensagens
            </div>
            <!-- Colocar um X na lateral direita -->
            <div class="topoxlistacontatos" onclick="fecharlistacontato()">
                <img src="../../COMUM/img/cursos/imagens/x.png">
            </div>
        </div>
        <div id="menulistacontatos">
            <div id="opcaoesquerdalistacontatos" class="selected" onclick="selecionarOpcao('opcaoesquerdalistacontatos')">Recentes</div>
            <div id="opcaodireitalistacontatos" onclick="selecionarOpcao('opcaodireitalistacontatos')">Lista</div>
        </div>

        <button id="botaoVoltar" style="display: none;" onclick="voltarParaContatos()">Voltar</button>

        <!-- Lista de contatos -->
        <div id="listaContatos"></div>

        <!-- Área do chat -->
        <div id="chatArea" style="display: none;">
            <div class="topomensagens">
                <div class="imagemdocontato">
                    <img src="" id="contatoImagem">
                </div>
                <div class="containerNomeDep">
                    <div class="nomedocontato" id="contatoNome"></div>
                    <div class="depdocontato" id="contatoDepartamento"></div>
                </div>
                <div class="cantodireito">
                    <div class="clipes">
                        <!--<button class="attention-button" title="Enviar Alerta">
                            <img src="../../../COPIZAP/IMAGEM/warning.png">
                        </button>-->
                    </div>
                </div>
            </div>
            <div class="mensagens" id="mensagens"></div>
            <div class="escrevermensagem">
                <div class="campoparaescrever">
                    <input type="text" name="mensagemtexto" class="mensagemtexto" id="mensagemtexto" placeholder="Digite uma mensagem...">
                </div>
                <div class="clipebutton">
                    <input type="file" id="fileupload" style="display: none;">
                    <label for="fileupload" class="clipebutton">
                        <img src="../../../COPIZAP/IMAGEM/clip.png" alt="Upload">
                    </label>
                    <div id="filePreview" style="display: none;">
                        <button id="fecharPreview">X</button>
                        <img id="previewImage" style="display: none;" />
                        <p id="fileName" style="display: none;"></p>
                    </div>
                </div>
                <div class="botaoenviar" onclick="enviarMensagem()">
                    <img src="../../../COPIZAP/IMAGEM/send.png">
                </div>
            </div>
        </div>
    </div>
</div>
