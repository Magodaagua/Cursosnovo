<!doctype html>
<html lang="pt-br">
	<?php
        //Conexão com o banco de dados
        include_once("php/conexao.php");

        //pega o usuario que foi passado pela URL
        $usuario = isset($_GET['Usuario']) ? $_GET['Usuario'] : null;

        //busca todas as informações do usuário no banco de dados e salva as informações em variáveis
        $result_usuario = "SELECT * FROM usuario WHERE Usuario = '$usuario' ";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
            $row_usuario['ID_usuario']."<br>";		
            $row_usuario['Senha']."<br>"; 

        $id_user = $row_usuario['ID_usuario'];
        $dep = $row_usuario['Dep'];
        $nome_usuario = $row_usuario['Nome'];
        $abreviacao = $row_usuario['Abreviacao'];
        
        // pega todas as informações da tabela inscrição filtrando pelo usuário e salvando na variavel $resultado_inscricao
        $result_inscricao = "SELECT * FROM inscricao WHERE id_usuario = '$id_user' ";
        $resultado_inscricao = mysqli_query($conn, $result_inscricao);
        $total_inscricao = mysqli_num_rows($resultado_inscricao);

        // pega algumas informações especificadas das tabelas curso e inscricao e junta tudo na variavel $resultado_cursos2
        $result_cursos2 = "SELECT c.ID_curso, c.Nome, c.Autor, c.Categoria, c.Subcategoria, c.Descricao, c.Datadecriacao, c.Carga_horaria, c.inscritos, c.imagem, i.progresso, i.data_conclusao
                           FROM curso c
                           INNER JOIN inscricao i ON c.ID_curso = i.id_curso
                           WHERE i.id_usuario = '$id_user'";

        $resultado_cursos2 = mysqli_query($conn, $result_cursos2);
        $total_cursos2 = mysqli_num_rows($resultado_cursos2);

        // Contar o total de cursos que o usuário está inscrito
        $result_contagem = "SELECT COUNT(*) AS total FROM inscricao WHERE id_usuario = '$id_user'";
        $contagem_resultado = mysqli_query($conn, $result_contagem);
        $contagem = mysqli_fetch_assoc($contagem_resultado);
        $total_meus_cursos = $contagem['total'];

	?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Nome do site -->
        <title>Meus Certificados Versão 2</title>
        <!--coloca o icone na aba da tela-->
        <link rel="icon" type="png" href="../../COMUM/img/Icons/Vermelho/imgML13.png">
        <!--CSS-->
        <link href="https://fonts.cdnfonts.com/css/community" rel="stylesheet">
        <link rel="stylesheet" href="css/tudo.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body data-id-user="<?php echo $id_user; ?>">
        <!-- menu superior -->
        <?php 
            require 'titulo.php'; 
        ?>
        <!-- titulo do site -->
        <div class="suportetitulo">
            Meus Certificados
        </div>
        <!-- espaço onde os certificados aparecem na tela -->
        <div class="certificadosretangulo">
            <?php
                if (mysqli_num_rows($resultado_cursos2) > 0) {
                    while ($row_curso = mysqli_fetch_assoc($resultado_cursos2)) {
                        // Obtenha a data de conclusão do curso do resultado da consulta
                        $data_conclusao = $row_curso["data_conclusao"];

                        // Array associativo para mapear os meses em inglês para português
                        $meses_pt = array(
                            'January' => 'Janeiro',
                            'February' => 'Fevereiro',
                            'March' => 'Março',
                            'April' => 'Abril',
                            'May' => 'Maio',
                            'June' => 'Junho',
                            'July' => 'Julho',
                            'August' => 'Agosto',
                            'September' => 'Setembro',
                            'October' => 'Outubro',
                            'November' => 'Novembro',
                            'December' => 'Dezembro'
                        );

                        // Converta a data para um formato legível com o mês em português
                        $data_legivel = date('d \d\e F \d\e Y', strtotime($data_conclusao));
                        $data_legivel = strtr($data_legivel, $meses_pt); // Substitui o nome do mês

                        // Exiba a data original e a data formatada
                        //echo "Data de Conclusão Original: " . $data_conclusao . '<br>';
                        //echo "Data Legível: " . $data_legivel . '<br>';

                        // Corpo dos certificados
                        echo "<div class='certificadoquadro'>";
                        echo "<div class='certificadoimagem'>";
                        echo '<img src="../../COMUM/img/cursos/capa_dos_cursos/' . $row_curso['imagem'] . '">';
                        echo "</div>";
                        echo "<div class='certificadonome'>";
                        echo '<div class="certificadonome2">'.$row_curso['Nome'].'</div>';
                        echo '  <div class="progresso-nova">
                                    <div class="progresso-barra-nova" style="width: '.$row_curso['progresso'] .'%">
                                    </div>
                                </div>
                                <div class="progresso-texto-novo">
                                '.$row_curso['progresso'].'%
                                </div>';
                        echo "</div>";
                
                        // Lógica para habilitar/desabilitar o botão de download
                        $isDownloadEnabled = ($row_curso['progresso'] == 100);
                        $buttonClass = $isDownloadEnabled ? '' : 'disabled';
                        $buttonHref = $isDownloadEnabled ? 'certificados.php?Nome_curso=' . $row_curso['Nome'] . '&data=' . $data_legivel . '&carga_horaria=' . $row_curso['Carga_horaria'] . '&Nome_usuario=' . $nome_usuario : 'javascript:void(0)'; // Define o href como vazio se não estiver habilitado
                        
                        echo "<div class='botaodedownloadcurriculo'>";
                        echo '<a href="' . $buttonHref . '" id="downloadButton_' . $row_curso['ID_curso'] . '" class="' . $buttonClass . ' btn-download">Download</a>';
                        echo "</div>";
                        
                        echo "</div>";
                    }
                } else {
                    echo "Você ainda não se cadastrou em nenhum curso.";
                }
            ?>
        </div>
        <?php
            } 
            //rodapé
            require "rodape.php"; 
        ?>
        <!-- javascript -->
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
        <script src="js/zoom.js"></script>
        <!--<script src="js/darkmode.js"></script>-->
    </body>
</html>