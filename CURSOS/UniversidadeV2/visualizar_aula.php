<!DOCTYPE html>
<html lang="pt-br">
    <?php

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        // conexão com banco de dados
        include_once("php/conexao.php");

        // conexão com o banco de dados via new pdo
        $pdo = new PDO('mysql:host=192.168.1.10;dbname=DevPortalCop', 'DevUser2', 'BV!A2k1$e61ms#yeQpE4j');

        // Inicializar variáveis para evitar avisos
        $idAulaseguinte = null;
        $idAulaAnterior = null;

        // Receber o ID do usuário
        $id_user = filter_input(INPUT_GET, 'id_user', FILTER_SANITIZE_NUMBER_INT);
        // Receber o ID da aula
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        // Receber o porcentagem da aula
        $porcentagem = filter_input(INPUT_GET, 'porcentagem', FILTER_SANITIZE_NUMBER_FLOAT);
        // Receber o ID da modulo
        $modulo_id = filter_input(INPUT_GET, 'modulo_id', FILTER_SANITIZE_NUMBER_INT);
        // Receber o ID do curso
        $curso_id = filter_input(INPUT_GET, 'curso_id', FILTER_SANITIZE_NUMBER_INT);
        // Recebe o número da posição que se enconta a aula
        $ordem = filter_input(INPUT_GET, 'ordem', FILTER_SANITIZE_NUMBER_INT);

        $idAulaAnterior = isset($_GET['id_aula_anterior']) ? $_GET['id_aula_anterior'] : null;

        // pega todas as informações do usuário e salva em variáveis 
        $result_usuario = "SELECT * FROM usuario WHERE Usuario = '$usuario' ";
        $resultado_usuario = mysqli_query($conn, $result_usuario);


        if ($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
            $id_user = $row_usuario['ID_usuario'];
            $dep = $row_usuario['Dep'];
            $nome_usuario = $row_usuario['Nome'];
            $abreviacao = $row_usuario['Abreviacao'];
        }

        // pega todas as informações do curso que teve o id passado pela URL
        $result_curso = "SELECT * FROM curso WHERE ID_curso = '$curso_id'";
        $resultado_curso = mysqli_query($conn, $result_curso);

        // Código PHP para pegar ID da aula seguinte e anterior
        $ordemSeguinte = $ordem + 1;
        $ordemAnterior = $ordem - 1;

        // Consultar a próxima aula
        $queryTesteAula2 = "SELECT aulas.*, modulos.curso_id 
                            FROM aulas 
                            INNER JOIN modulos ON aulas.modulo_id = modulos.id 
                            WHERE aulas.ordem = :ordemSeguinte AND modulos.curso_id = :curso_id";
        $stmt2 = $pdo->prepare($queryTesteAula2);
        $stmt2->bindParam(':ordemSeguinte', $ordemSeguinte, PDO::PARAM_INT);
        $stmt2->bindParam(':curso_id', $curso_id, PDO::PARAM_INT);
        $stmt2->execute();

        $aulaSeguinte = $stmt2->fetch(PDO::FETCH_ASSOC);
        $idAulaseguinte = $aulaSeguinte ? $aulaSeguinte['id'] : null;
        $ordemseguinte2 = $aulaSeguinte ? $aulaSeguinte['ordem'] : null;

        // Função para verificar se a aula existe
        function aulaExiste($pdo, $idAula) {
            $queryVerificaAula = "SELECT COUNT(*) FROM aulas WHERE id = :idAula";
            $stmtVerificaAula = $pdo->prepare($queryVerificaAula);
            $stmtVerificaAula->bindParam(':idAula', $idAula, PDO::PARAM_INT);
            $stmtVerificaAula->execute();
            return $stmtVerificaAula->fetchColumn() > 0;
        }

        // Verificar se o usuário está inscrito na aula atual e inscrever se não estiver
        if (isset($id_user) && isset($id) && aulaExiste($pdo, $id)) {
            // Consultar a inscrição na aula atual
            $queryInscricaoAtual = "SELECT * FROM progresso_aula WHERE id_usuario = :id_user AND id_aula = :id";
            $stmtInscricaoAtual = $pdo->prepare($queryInscricaoAtual);
            $stmtInscricaoAtual->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmtInscricaoAtual->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtInscricaoAtual->execute();

            // Inscrever se não estiver inscrito
            if ($stmtInscricaoAtual->rowCount() === 0) {
                $queryInscreverAtual = "INSERT INTO progresso_aula (id_usuario, id_curso, id_aula, concluida) VALUES (:id_user, :id_curso, :id, 0)";
                $stmtInscreverAtual = $pdo->prepare($queryInscreverAtual);
                $stmtInscreverAtual->bindParam(':id_user', $id_user, PDO::PARAM_INT);
                $stmtInscreverAtual->bindParam(':id_curso', $curso_id, PDO::PARAM_INT);
                $stmtInscreverAtual->bindParam(':id', $id, PDO::PARAM_INT);
                $stmtInscreverAtual->execute();
            }
        }

        // Verificar se o usuário está inscrito na próxima aula e inscrever se não estiver
        if (isset($id_user) && isset($idAulaseguinte) && aulaExiste($pdo, $idAulaseguinte)) {
            // Consultar a inscrição na próxima aula
            $queryInscricaoSeguinte = "SELECT * FROM progresso_aula WHERE id_usuario = :id_user AND id_aula = :idAulaseguinte";
            $stmtInscricaoSeguinte = $pdo->prepare($queryInscricaoSeguinte);
            $stmtInscricaoSeguinte->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmtInscricaoSeguinte->bindParam(':idAulaseguinte', $idAulaseguinte, PDO::PARAM_INT);
            $stmtInscricaoSeguinte->execute();

            // Inscrever se não estiver inscrito
            if ($stmtInscricaoSeguinte->rowCount() === 0) {
                $queryInscreverSeguinte = "INSERT INTO progresso_aula (id_usuario, id_curso, id_aula, concluida) VALUES (:id_user, :id_curso, :idAulaseguinte, 0)";
                $stmtInscreverSeguinte = $pdo->prepare($queryInscreverSeguinte);
                $stmtInscreverSeguinte->bindParam(':id_user', $id_user, PDO::PARAM_INT);
                $stmtInscreverSeguinte->bindParam(':id_curso', $curso_id, PDO::PARAM_INT);
                $stmtInscreverSeguinte->bindParam(':idAulaseguinte', $idAulaseguinte, PDO::PARAM_INT);
                $stmtInscreverSeguinte->execute();
            }
        }

        // Verificar se o usuário está inscrito na aula anterior e inscrever se não estiver
        if (isset($id_user) && isset($idAulaAnterior) && aulaExiste($pdo, $idAulaAnterior)) {
            // Consultar a inscrição na aula anterior
            $queryInscricaoAnterior = "SELECT * FROM progresso_aula WHERE id_usuario = :id_user AND id_aula = :idAulaAnterior";
            $stmtInscricaoAnterior = $pdo->prepare($queryInscricaoAnterior);
            $stmtInscricaoAnterior->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmtInscricaoAnterior->bindParam(':idAulaAnterior', $idAulaAnterior, PDO::PARAM_INT);
            $stmtInscricaoAnterior->execute();

            // Inscrever se não estiver inscrito
            if ($stmtInscricaoAnterior->rowCount() === 0) {
                $queryInscreverAnterior = "INSERT INTO progresso_aula (id_usuario, id_curso, id_aula, concluida) VALUES (:id_user, :id_curso, :idAulaAnterior, 0)";
                $stmtInscreverAnterior = $pdo->prepare($queryInscreverAnterior);
                $stmtInscreverAnterior->bindParam(':id_user', $id_user, PDO::PARAM_INT);
                $stmtInscreverAnterior->bindParam(':id_curso', $curso_id, PDO::PARAM_INT);
                $stmtInscreverAnterior->bindParam(':idAulaAnterior', $idAulaAnterior, PDO::PARAM_INT);
                $stmtInscreverAnterior->execute();
            }
        }

        // Consultar a aula anterior
        $queryTesteAula = "SELECT aulas.*, modulos.curso_id 
                            FROM aulas 
                            INNER JOIN modulos ON aulas.modulo_id = modulos.id 
                            WHERE aulas.ordem = :ordemAnterior AND modulos.curso_id = :curso_id";
        $stmt = $pdo->prepare($queryTesteAula);
        $stmt->bindParam(':ordemAnterior', $ordemAnterior, PDO::PARAM_INT);
        $stmt->bindParam(':curso_id', $curso_id, PDO::PARAM_INT);
        $stmt->execute();

        $aulaAnterior = $stmt->fetch(PDO::FETCH_ASSOC);
        $idAulaAnterior = $aulaAnterior ? $aulaAnterior['id'] : null;
        $ordemAnterior2 = $aulaAnterior ? $aulaAnterior['ordem'] : null;


        //}

        // Debug para verificar a razão de $idAulaAnterior ser null
        //echo "Debug: ordemAnterior=$ordemAnterior, modulo_id=$modulo_id, curso_id=$curso_id, idAulaAnterior=$idAulaAnterior";

        // Verificar se as variáveis $id_user e $id estão definidas
        if (isset($id_user) && isset($id)) {
            // Consulta para verificar se o usuário favoritou a aula
            $queryFavoritar = "SELECT * FROM aulas_favoritas WHERE id_cliente = :id_user AND id_aula = :id_aula";
            $teste = $pdo->prepare($queryFavoritar);
            $teste->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $teste->bindParam(':id_aula', $id, PDO::PARAM_INT);
            $teste->execute();
        
            // Verificar se o usuário foi encontrado na tabela das aulas favoritas
            if ($teste->rowCount() > 0) {
                // Recuperar os dados da aula favorita
                $aulasfavoritas = $teste->fetch(PDO::FETCH_ASSOC);
                $idaulasfavoritas = $aulasfavoritas['id_aula']; // ID da aula 
                $useraulasfavoritas = $aulasfavoritas['id_cliente']; // ID do usuário
                $informacoesaulasfavoritas = $aulasfavoritas['informacao']; // verificar 
        
                // Definir o valor de $favorito com base na coluna 'informacoes'
                if ($informacoesaulasfavoritas == '1') {
                    // Se igual a 1 no banco de dados, já está salvo como favorito
                    $favorito = 1;
                } else {
                    // Se igual a 0 no banco de dados, já está salvo como não favorito
                    $favorito = 2;
                }
            } else {
                // O usuário não favoritou essa aula ainda
                $favorito = 0;
            }
        } else {
            // Caso as variáveis $id_user ou $id não estejam definidas, definir $favorito como 0
            $favorito = 0;
        }   

        // Consultar informações da aula
        $query_aula = "SELECT titulo, conteudo, pdf, resumo, modulo_id, prova FROM aulas WHERE id=:id LIMIT 1";
        $result_aula = $pdo->prepare($query_aula);
        $result_aula->bindParam(':id', $id, PDO::PARAM_INT);
        $result_aula->execute();
        $row_aula = $result_aula->fetch(PDO::FETCH_ASSOC);
        $titulo = mb_strimwidth($row_aula['titulo'], 0, 25, '...');
        $conteudo = $row_aula['conteudo'];
        $ehProva = $row_aula['prova'] == 1;

        $prova_feita = null; // Defina como null por padrão para evitar avisos

        // Se for uma prova, buscar o id da prova e as questões
        if ($ehProva) {
            // Buscar o prova_id na tabela prova
            $query_prova = "SELECT id FROM provas WHERE aula_id=:aula_id LIMIT 1";
            $result_prova = $pdo->prepare($query_prova);
            $result_prova->bindParam(':aula_id', $id, PDO::PARAM_INT);
            $result_prova->execute();
            $row_prova = $result_prova->fetch(PDO::FETCH_ASSOC);
            $prova_id = $row_prova['id'];

            // Buscar as questões usando o prova_id
            $query_questoes = "SELECT id, pergunta, resposta_a, resposta_b, resposta_c, resposta_d FROM questoes WHERE prova_id=:prova_id";
            $result_questoes = $pdo->prepare($query_questoes);
            $result_questoes->bindParam(':prova_id', $prova_id, PDO::PARAM_INT);
            $result_questoes->execute();
            $questoes = $result_questoes->fetchAll(PDO::FETCH_ASSOC);

            // Verificar se o usuário já fez a prova
            $query_prova_feita = "SELECT * FROM provafeita WHERE prova_id=:prova_id AND usuario_id=:usuario_id LIMIT 1";
            $stmt_prova_feita = $pdo->prepare($query_prova_feita);
            $stmt_prova_feita->bindParam(':prova_id', $id, PDO::PARAM_INT);
            $stmt_prova_feita->bindParam(':usuario_id', $id_user, PDO::PARAM_INT);
            $stmt_prova_feita->execute();
            $prova_feita = $stmt_prova_feita->fetch(PDO::FETCH_ASSOC);


            // Consultar a inscrição do usuário na aula atual
            $queryInscricaoAtual = "SELECT * FROM progresso_aula WHERE id_usuario = :id_user AND id_aula = :id";
            $stmtInscricaoAtual = $pdo->prepare($queryInscricaoAtual);
            $stmtInscricaoAtual->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmtInscricaoAtual->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtInscricaoAtual->execute();

            $usuarioInscrito = $stmtInscricaoAtual->rowCount() > 0;
        }
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Titulo -->
        <title>Visualizar Aula 2</title>
        <!--coloca o icone na aba da tela-->
        <link rel="icon" type="png" href="../../COMUM/img/Icons/Vermelho/imgML13.png">
        <!--CSS-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.cdnfonts.com/css/community" rel="stylesheet">
        <link rel="stylesheet" href="css/tudo.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body data-id-user="<?php echo $id_user; ?>">
        <?php 
            // menu superior
            require "titulo.php"; 

            //busca no banco de dados 
            $query_aula = " SELECT aul.titulo, aul.conteudo, aul.pdf, aul.resumo, aul.modulo_id, aul.prova,
                                    mdu.curso_id
                            FROM aulas aul
                            INNER JOIN modulos AS mdu ON mdu.id=aul.modulo_id
                            WHERE aul.id=:id
                            /*WHERE aul.id=:id AND aul.modulo_id =:modulo_id AND mdu.curso_id =:curso_id*/
                            LIMIT 1";
            $result_aula = $pdo->prepare($query_aula);
            $result_aula->bindParam(':id', $id);
            //$result_aula->bindParam(':aul.modulo_id', $modulo_id);
            //$result_aula->bindParam(':mdu.curso_id', $curso_id);
            $result_aula->execute();

            // Acessa o IF quando encontrar a aula no BD
            if (($result_aula) and ($result_aula->rowCount() != 0)) {
                $row_aula = $result_aula->fetch(PDO::FETCH_ASSOC);
                //var_dump($row_aula);
                extract($row_aula);
                $titulo = mb_strimwidth($row_aula['titulo'], 0, 25, '...');
        ?>
        <div class="botaovoltarteste2">
            <a href='detalhes.php?ID_curso=<?php echo $curso_id; ?>&progresso=0&Usuario=<?php echo $usuario; ?>'>
                <img src="../../COMUM/img/cursos/imagens/home.png">
            </a>
        </div>
        <!-- página toda -->
        <div class="quadradograndeaulas">
            <!-- campo da direita onde fica o video -->
            <?php
                if ($ehProva) {
                    // Verificar se a prova já foi feita pelo usuário
                    $query_prova_feita = "SELECT * FROM provafeita WHERE prova_id=:prova_id AND usuario_id=:usuario_id LIMIT 1";
                    $stmt_prova_feita = $pdo->prepare($query_prova_feita);
                    $stmt_prova_feita->bindParam(':prova_id', $prova_id, PDO::PARAM_INT);
                    $stmt_prova_feita->bindParam(':usuario_id', $id_user, PDO::PARAM_INT);
                    $stmt_prova_feita->execute();
                    $prova_feita = $stmt_prova_feita->fetch(PDO::FETCH_ASSOC);

                    // Verificar se a prova já foi tentada, se sim, exibir apenas mensagem
                    if ($prova_feita) {
                        $nota = $prova_feita['nota'];
                        $acertos = $prova_feita['acertos'];
                        $total_questoes = $prova_feita['total_questoes'];
                        $tentativas = $prova_feita['tentativas'];
                
                        echo '<div class="videoaulas"><div id="prova-finalizada">';
                        echo '<p>Prova finalizada</p><p>Nota: ' . $nota . '%</p><p>Acertos: ' . $acertos . ' / ' . $total_questoes . '</p>';
                
                        if ($nota < 70) {
                            if ($tentativas == 3) {
                                echo '<form method="post" action="php/processar_prova.php" id="form-prova">';
                                foreach ($questoes as $index => $questao) {
                                    $inscrito = $usuarioInscrito ? 'true' : 'false';
                                    echo '<div class="questao" id="questao-' . $index . '" data-inscrito="' . $inscrito . '" style="display: ' . ($index === 0 ? 'block' : 'none') . ';">';
                                    echo '<p>' . ($index + 1) . '. ' . htmlspecialchars($questao['pergunta']) . '</p>';
                                    echo '<label><input type="radio" name="resposta[' . $questao['id'] . ']" value="A">' . htmlspecialchars($questao['resposta_a']) . '</label><br>';
                                    echo '<label><input type="radio" name="resposta[' . $questao['id'] . ']" value="B">' . htmlspecialchars($questao['resposta_b']) . '</label><br>';
                                    echo '<label><input type="radio" name="resposta[' . $questao['id'] . ']" value="C">' . htmlspecialchars($questao['resposta_c']) . '</label><br>';
                                    echo '<label><input type="radio" name="resposta[' . $questao['id'] . ']" value="D">' . htmlspecialchars($questao['resposta_d']) . '</label><br>';
                                    echo '<div class="navegacao">';
                                    if ($index > 0) {
                                        echo '<button type="button" class="anterior">Anterior</button>';
                                    }
                                    if ($index < count($questoes) - 1) {
                                        echo '<button type="button" class="proxima">Próxima</button>';
                                    } else {
                                        echo '<button type="button" id="enviar-prova-btn">Enviar Prova</button>';
                                    }
                                    echo '</div></div>';
                                }
                                echo '<input type="hidden" name="id_user" value="' . $id_user . '">';
                                echo '<input type="hidden" name="prova_id" value="' . $prova_id . '">';
                                echo '<input type="hidden" name="modulo_id" value="' . $modulo_id . '">';
                                echo '<input type="hidden" name="curso_id" value="' . $curso_id . '">';
                                echo '<input type="hidden" name="ordem" value="' . $ordem . '">';
                                echo '<input type="hidden" name="aula_id" value="' . $id . '">';
                                echo '</form>';
                            } elseif ($tentativas == 4) {
                                echo '<p>Você já tentou a prova 2 vezes. Aguarde a revisão do administrador.</p>';
                            } else {
                                echo '<button type="button" id="tentar-novamente-btn">Tentar Novamente</button>';
                            }
                        }
                
                        echo '</div></div>';
                    } elseif (isset($_GET['finalizada']) && $_GET['finalizada'] == 1) {
                        // Se a prova foi finalizada recentemente, exibir informações da prova via GET
                        $nota = $_GET['nota'];
                        $acertos = $_GET['acertos'];
                        $total_questoes = $_GET['total_questoes'];
                        $tentativas = $_GET['tentativas'];
                
                        echo '<div class="videoaulas"><div id="prova-finalizada">';
                        echo '<p>Prova finalizada</p><p>Nota: ' . $nota . '%</p><p>Acertos: ' . $acertos . ' / ' . $total_questoes . '</p>';
                
                        if ($nota < 70) {
                            if ($tentativas == 3) {
                                echo '<form method="post" action="php/processar_prova.php" id="form-prova">';
                                foreach ($questoes as $index => $questao) {
                                    $inscrito = $usuarioInscrito ? 'true' : 'false';
                                    echo '<div class="questao" id="questao-' . $index . '" data-inscrito="' . $inscrito . '" style="display: ' . ($index === 0 ? 'block' : 'none') . ';">';
                                    echo '<p>' . ($index + 1) . '. ' . htmlspecialchars($questao['pergunta']) . '</p>';
                                    echo '<label><input type="radio" name="resposta[' . $questao['id'] . ']" value="A">' . htmlspecialchars($questao['resposta_a']) . '</label><br>';
                                    echo '<label><input type="radio" name="resposta[' . $questao['id'] . ']" value="B">' . htmlspecialchars($questao['resposta_b']) . '</label><br>';
                                    echo '<label><input type="radio" name="resposta[' . $questao['id'] . ']" value="C">' . htmlspecialchars($questao['resposta_c']) . '</label><br>';
                                    echo '<label><input type="radio" name="resposta[' . $questao['id'] . ']" value="D">' . htmlspecialchars($questao['resposta_d']) . '</label><br>';
                                    echo '<div class="navegacao">';
                                    if ($index > 0) {
                                        echo '<button type="button" class="anterior">Anterior</button>';
                                    }
                                    if ($index < count($questoes) - 1) {
                                        echo '<button type="button" class="proxima">Próxima</button>';
                                    } else {
                                        echo '<button type="button" id="enviar-prova-btn">Enviar Prova</button>';
                                    }
                                    echo '</div></div>';
                                }
                                echo '<input type="hidden" name="id_user" value="' . $id_user . '">';
                                echo '<input type="hidden" name="prova_id" value="' . $prova_id . '">';
                                echo '<input type="hidden" name="modulo_id" value="' . $modulo_id . '">';
                                echo '<input type="hidden" name="curso_id" value="' . $curso_id . '">';
                                echo '<input type="hidden" name="ordem" value="' . $ordem . '">';
                                echo '<input type="hidden" name="aula_id" value="' . $id . '">';
                                echo '</form>';
                            } elseif ($tentativas == 4) {
                                echo '<p>Você já tentou a prova 3 vezes. Aguarde a revisão do administrador.</p>';
                            } else {
                                echo '<button type="button" id="tentar-novamente-btn">Tentar Novamente</button>';
                            }
                        }
                
                        echo '</div></div>';
                    } else {
                        // Lógica para exibir a prova se ela ainda não foi feita
                        echo '<div class="videoaulas">';
                            echo '<form method="post" action="php/processar_prova.php" id="form-prova">';
                                foreach ($questoes as $index => $questao) {
                                    $inscrito = $usuarioInscrito ? 'true' : 'false';
                                    echo '<div class="questao" id="questao-' . $index . '" data-inscrito="' . $inscrito . '" style="display: ' . ($index === 0 ? 'block' : 'none') . ';">';
                                    echo '<p>' . ($index + 1) . '. ' . htmlspecialchars($questao['pergunta']) . '</p>';
                                    echo '<label><input type="radio" name="resposta[' . $questao['id'] . ']" value="A">' . htmlspecialchars($questao['resposta_a']) . '</label><br>';
                                    echo '<label><input type="radio" name="resposta[' . $questao['id'] . ']" value="B">' . htmlspecialchars($questao['resposta_b']) . '</label><br>';
                                    echo '<label><input type="radio" name="resposta[' . $questao['id'] . ']" value="C">' . htmlspecialchars($questao['resposta_c']) . '</label><br>';
                                    echo '<label><input type="radio" name="resposta[' . $questao['id'] . ']" value="D">' . htmlspecialchars($questao['resposta_d']) . '</label><br>';
                                    echo '<div class="navegacao">';
                                    if ($index > 0) {
                                        echo '<button type="button" class="anterior">Anterior</button>';
                                    }
                                    if ($index < count($questoes) - 1) {
                                        echo '<button type="button" class="proxima">Próxima</button>';
                                    } else {
                                        echo '<button type="button" id="enviar-prova-btn">Enviar Prova</button>';
                                    }
                                    echo '</div></div>';
                                }
                                echo '<input type="hidden" name="id_user" value="' . $id_user . '">';
                                echo '<input type="hidden" name="prova_id" value="' . $prova_id . '">';
                                echo '<input type="hidden" name="modulo_id" value="' . $modulo_id . '">';
                                echo '<input type="hidden" name="curso_id" value="' . $curso_id . '">';
                                echo '<input type="hidden" name="ordem" value="' . $ordem . '">';
                                echo '<input type="hidden" name="aula_id" value="' . $id . '">';
                            echo '</form>';
                        echo '</div>';
                    }
                } else {
                    // Se não for uma prova, apenas exibir o conteúdo da aula
                    echo '<div class="videoaulas">';
                    echo $conteudo;
                    echo '</div>';
                }
            ?>

        <!-- Formulário escondido para tentar novamente -->
        <form id="form-tentar-novamente" method="post" action="php/tentar_novamente.php">
            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
            <input type="hidden" name="prova_id" value="<?php echo $prova_id; ?>">
            <input type="hidden" name="aula_id" value="<?php echo $id; ?>">
            <input type="hidden" name="modulo_id" value="<?php echo $modulo_id; ?>">
            <input type="hidden" name="curso_id" value="<?php echo $curso_id; ?>">
            <input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
        </form>

        <script>
           document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('tentar-novamente-btn').addEventListener('click', function () {
                    document.getElementById('form-tentar-novamente').submit();
                });
            });
        </script>

            <!-- retangulo lateral onde fica as opções e informações -->
            <div class="retangulolateralesquerdacomaulas">
                <!-- opções do topo -->
                <div class="retangulolateralesquerdacomaulastitulos">
                    <!-- botão aulas -->
                    <div class="botaoaulas" id="openMenu">
                        <img src="../../COMUM/img/cursos/imagens/menu.png">&nbsp;
                        Aulas
                    </div>
                    <!-- anotações -->
                    <a href="anotacoes.php?Usuario=<?php echo $usuario;?>">
                        <div class="botaoanotacoesverde">
                            <img src="../../COMUM/img/cursos/imagens/bloco-de-anotacoes.png">
                        </div>
                    </a>
                    <!-- favoritar -->
                    <!-- Verificar o estado do favorito e exibir o botão correto -->
                    <form class="favoritaform" method="post" action="favoritar.php">
                        <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                        <input type="hidden" name="id_aula" value="<?php echo $id; ?>">
                        <input type="hidden" name="favorito" value="<?php echo $favorito == 1 ? 0 : 1; ?>">
                        <input type="hidden" name="porcentagem" value="<?php echo $porcentagem;?>">
                        <input type="hidden" name="modulo_id" value="<?php echo $modulo_id;?>">
                        <input type="hidden" name="curso_id" value="<?php echo $curso_id;?>">
                        <input type="hidden" name="ordem" value="<?php echo $ordem;?>">
                        <button type="button" id="favoritar-btn" data-favorito="<?php echo $favorito; ?>" class="botaofavoritar">
                            <img src="../../COMUM/img/cursos/imagens/<?php echo $favorito == 1 ? 'gostar2.png' : 'gostar.png'; ?>" />
                        </button>
                    </form>
                    <!-- Adicionar JavaScript para manipular o clique no botão -->
                    <script>
                        document.getElementById('favoritar-btn').addEventListener('click', function() {
                            var favoritarBtn = this;
                            var favorito = favoritarBtn.getAttribute('data-favorito');
                            var id_user = <?php echo json_encode($id_user); ?>;
                            var id_aula = <?php echo json_encode($id); ?>;
                            var modulo_id = <?php echo json_encode($modulo_id); ?>;
                            var curso_id = <?php echo json_encode($curso_id); ?>;
                            var ordem = <?php echo json_encode($ordem); ?>;

                            var newFavorito = favorito == 1 ? 0 : 1; // Alternar entre favorito e não favorito

                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', 'favoritar.php', true);
                            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === 4 && xhr.status === 200) {
                                    console.log(xhr.responseText); // Verifica o que está sendo retornado pelo servidor
                                    if (xhr.responseText.trim() === 'success') {
                                        // Atualiza a imagem do botão com base no novo estado
                                        favoritarBtn.setAttribute('data-favorito', newFavorito);
                                        favoritarBtn.querySelector('img').src = newFavorito == 1 ? '../../COMUM/img/cursos/imagens/gostar2.png' : '../../COMUM/img/cursos/imagens/gostar.png';
                                    } else {
                                        console.log('Resposta do servidor:', xhr.responseText);
                                        alert('Erro ao atualizar o favorito. Resposta do servidor: ' + xhr.responseText);
                                    }
                                }
                            };
                            xhr.send('id_user=' + id_user + '&id_aula=' + id_aula + '&favorito=' + newFavorito + '&modulo_id=' + modulo_id + '&curso_id=' + curso_id + '&ordem=' + ordem);
                        });
                    </script>
                    <!-- calendario  -->
                    <a href="calendario.php?id_user=<?php echo $id_user ?>">
                        <div class="botaocalendario">
                            <img src="../../COMUM/img/cursos/imagens/calendario.png">
                        </div>
                    </a>
                    <!-- Botão para a aula anterior -->
                    <?php 
                        if ($idAulaAnterior != null) {
                            $linkAnterior = "visualizar_aula.php?id_usuario=$id_user&id=$idAulaAnterior&modulo_id=$modulo_id&curso_id=$curso_id&ordem=$ordemAnterior2";
                            echo "<a href='$linkAnterior'><div class='botaotras'><img src='../../COMUM/img/cursos/imagens/seta.png'></div></a>";
                            echo "<!-- URL Anterior: $linkAnterior -->"; // Depuração
                        } else {
                            echo "<div class='botaotrasn'><img src='../../COMUM/img/cursos/imagens/seta.png'></div>";
                        }
                    ?>
                    <!-- Botão para a próxima aula -->
                    <?php 
                        if ($idAulaseguinte != null) {
                            $linkSeguinte = "visualizar_aula.php?id_usuario=$id_user&id=$idAulaseguinte&modulo_id=$modulo_id&curso_id=$curso_id&ordem=$ordemseguinte2";
                            echo "<a href='$linkSeguinte'><div class='botaofrente'><img src='../../COMUM/img/cursos/imagens/seta.png'></div></a>";
                            echo "<!-- URL Seguinte: $linkSeguinte -->"; // Depuração
                        } else {
                            echo "<div class='botaofrenten'><img src='../../COMUM/img/cursos/imagens/seta.png'></div>";
                        }
                    ?>
                </div>
                <!-- titulo da aula, descricão, pdf, feedback e finalizar --> 
                <div class="retangulolateralesquerdacomaulasdescricao">
                    <!-- titulo da aula -->
                    <div class="retangulolateraltitulo">
                        <?php echo $titulo; ?>
                    </div>
                    <!-- menu inferior para ficar trocando informação -->
                    <div class="retangulolateralopcoes">
                        <!-- menu inferior -->
                        <div class="tabs">
                            <button class="tab-button active" data-tab="home">Descrição</button>
                            <button class="tab-button" data-tab="profile">PDFs</button>
                            <button class="tab-button" data-tab="contact">Feedback</button>
                            <button class="tab-button" data-tab="comentario">Comentários</button>
                            <?php
                                // Renderiza o botão "Finaliza" apenas se não for uma prova
                                if ($prova == 0) {
                                    echo '<button class="tab-button" data-tab="finalizarbotao">Finaliza</button>';
                                }else{

                                }
                            ?>
                            <!--<button class="tab-button" data-tab="finalizarbotao">Finaliza</button>-->
                            <div class="tab-indicator"></div> <!-- Linha dourada -->
                        </div>

                        <!-- parte do menu responsavel pelo botão de finalizar -->
                        <div class="tab-content" id="tab-content">
                            <div class="tab-pane" id="finalizarbotao-content">
                                <!-- Formulário de conclusão de aula -->
                                <form class="formbotao" action="php/atualizar_progresso.php" method="POST">
                                    <button class="botaofinalizacao" type="submit">Concluir Aula</button>
                                    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                                    <input type="hidden" name="id_curso" value="<?php echo $curso_id; ?>">
                                    <input type="hidden" name="modulo_id" value="<?php echo $modulo_id; ?>">
                                    <input type="hidden" name="id_aula" value="<?php echo $id; ?>">
                                    <input type="hidden" name="porcentagem" value="100">
                                    <input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
                                    <input type="hidden" name="id_aula_seguinte" value="<?php echo $idAulaseguinte; ?>">
                                </form>
                            </div>
                            <!-- descrição do curso -->
                            <div class="tab-pane active" id="home-content">
                                <?php
                                    if($resumo != ''){
                                        echo $resumo; 
                                    }else{
                                        echo "Ainda não foi regitrado nenhuma descrição para esse curso";
                                    }
                                ?>
                            </div>
                            <!-- PDF's -->
                            <div class="tab-pane" id="profile-content">
                                <?php 
                                    //$pdo = new PDO('mysql:host=localhost;dbname=devportalcop', 'root', '');

                                    // Informações do curso, módulo e aula
                                    $id_curso = $curso_id;  // substitua pelo ID do curso atual
                                    $id_modulo = $modulo_id; // substitua pelo ID do módulo atual (já obtido no código anterior)
                                    $id_aula = $id;   // substitua pelo ID da aula atual

                                    /*echo "curso id: ". $id_curso. "<br> modulo id: " . $id_modulo ."<br>aula id: ". $id_aula. "<br>";*/

                                    // Consulta para obter o nome do PDF associado à aula atual
                                    $query_pdf = "SELECT pdf_aula.nome FROM pdf_aula
                                                WHERE pdf_aula.curso_id = :curso_id
                                                AND pdf_aula.modulo_id = :modulo_id
                                                AND pdf_aula.aula_id = :aula_id";

                                    $stmt_pdf = $pdo->prepare($query_pdf);
                                    $stmt_pdf->bindParam(':curso_id', $id_curso);
                                    $stmt_pdf->bindParam(':modulo_id', $id_modulo);
                                    $stmt_pdf->bindParam(':aula_id', $id_aula);
                                    $stmt_pdf->execute();

                                    // Adicione var_dump para depuração
                                    //var_dump($id_curso, $id_modulo, $id_aula);

                                    if ($stmt_pdf->rowCount() > 0) {
                                        echo "<div class='pdfbox'>";
                                        echo "<div class='listadepdfs'>"; // Abre a div.listadepdfs
                                
                                        $pdf_count = 0; // Inicializa o contador de PDFs exibidos
                                        foreach ($stmt_pdf as $row_pdf) {
                                            $pdf_count++;
                                            $nome_pdf = $row_pdf['nome'];
                                
                                            // Abre uma nova linha a cada dois PDFs
                                            if ($pdf_count % 2 == 1) {
                                                echo "<div class='pdf-row'>";
                                            }
                                
                                            echo "<div class='pdfinformacao'>";
                                            echo "<img src='../PDF/documents.png'>$nome_pdf<br><br>";
                                            echo "<a href='../PDF/$nome_pdf' download>Download</a>";
                                            echo "</div>";
                                
                                            // Fecha a linha da div após exibir dois PDFs
                                            if ($pdf_count % 2 == 0) {
                                                echo "</div>"; // Fecha a div.pdf-row
                                            }
                                        }
                                
                                        // Fecha a linha final caso o último grupo de PDFs não tenha completado uma linha completa
                                        if ($pdf_count % 2 != 0) {
                                            echo "</div>"; // Fecha a div.pdf-row
                                        }
                                
                                        echo "</div>"; // Fecha a div.listadepdfs
                                        echo "</div>"; // Fecha a div.pdfbox
                                    } else {
                                        echo "Não há PDF cadastrado nesta aula";
                                    }
                                ?>
                            </div>
                            <!-- parte dos comentários dos usuários  -->
                            <div class="tab-pane" id="contact-content">
                                <form class="form-horizontal" action="php/processa.php?aula_id=<?php echo $id?>&modulo_id=<?php echo $modulo_id?>&curso_id=<?php echo $curso_id?>&ID_usuario=<?php echo $id_user ?>" method="POST">
                                    <h1 class="tituloavaliacao">&nbsp;Avalie a Aula</h1><br>
                                    <!-- Início do formulário de avaliação -->
                                    <div class="estrelas">
                                        <!-- Carrega o formulário definindo nenhuma estrela selecionada -->
                                        <input type="radio" name="estrela" id="vazio" value="" checked>
                                        <!-- Opção para selecionar 1 estrela -->
                                        <label for="estrela_um"><i class="opcao fa"></i></label>
                                        <input type="radio" name="estrela" id="estrela_um" value="1">
                                        <!-- Opção para selecionar 2 estrelas -->
                                        <label for="estrela_dois"><i class="opcao fa"></i></label>
                                        <input type="radio" name="estrela" id="estrela_dois" value="2">
                                        <!-- Opção para selecionar 3 estrelas -->
                                        <label for="estrela_tres"><i class="opcao fa"></i></label>
                                        <input type="radio" name="estrela" id="estrela_tres" value="3">
                                        <!-- Opção para selecionar 4 estrelas -->
                                        <label for="estrela_quatro"><i class="opcao fa"></i></label>
                                        <input type="radio" name="estrela" id="estrela_quatro" value="4">
                                        <!-- Opção para selecionar 5 estrelas -->
                                        <label for="estrela_cinco"><i class="opcao fa"></i></label>
                                        <input type="radio" name="estrela" id="estrela_cinco" value="5"><br><br>
                                        <!-- Campo para enviar a mensagem -->
                                        <textarea class="mensagensavaliacoes" name="mensagem" rows="4" cols="100" placeholder="Digite o seu comentário..."></textarea><br><br>
                                        <!-- Botão para enviar os dados do formulário -->
                                        <button type="submit" class='botaodeenviodeavalicao'>Cadastrar</button><br><br>
                                    </div>
                                </form>
                            </div>
                            <!-- parte dos comentários geral  -->
                            <div class="tab-pane" id="comentario-content">
                                <div class="form-group">
                                    <h1 class="titulocomentarios">&nbsp;Comentários</h1><br>
                                    <div class="messages">
                                        <!-- Lista de mensagens -->
                                        <?php
                                            // Recuperar as avaliações do banco de dados com o nome do usuário
                                            $query_avaliacoes = "SELECT a.id, a.qtd_estrela, a.mensagem, a.aula_id, a.curso_id, a.modulo_id, a.id_user, u.Nome
                                                FROM avaliacoes AS a
                                                INNER JOIN usuario AS u ON a.id_user = u.ID_usuario
                                                WHERE a.modulo_id = :id_modulo AND a.curso_id = :id_curso AND a.aula_id = :id_aula
                                                ORDER BY a.id DESC";
                                            $result_avaliacoes = $con->prepare($query_avaliacoes);
                                            $result_avaliacoes->bindParam(':id_modulo', $id_modulo, PDO::PARAM_INT);
                                            $result_avaliacoes->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
                                            $result_avaliacoes->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);

                                            // Executar a QUERY
                                            if ($result_avaliacoes->execute()) {
                                                   // Verificar se há avaliações encontradas
                                                if ($result_avaliacoes->rowCount() > 0) {
                                                    // Percorrer a lista de registros recuperada do banco de dados
                                                    while ($row_avaliacao = $result_avaliacoes->fetch(PDO::FETCH_ASSOC)) {
                                                        // Extrair o array para imprimir pelo nome do elemento do array
                                                        extract($row_avaliacao);

                                                        // Exibir o nome do usuário avaliador e as estrelas
                                                        echo "<div class='message'>";
                                                        echo "<p>Avaliado por: $Nome</p>";
                                                        for ($i = 1; $i <= 5; $i++) {
                                                            if ($i <= $qtd_estrela) {
                                                                echo '<i class="estrela-preenchida fa-solid fa-star"></i>';
                                                            } else {
                                                                echo '<i class="estrela-vazia fa-solid fa-star"></i>';
                                                            }
                                                        }
                                                        echo "<p>Mensagem: $mensagem</p>";
                                                        echo "</div>";
                                                    }
                                                } else {
                                                    // Caso não haja avaliações encontradas
                                                    echo "<p>Este curso não foi avaliado ainda.</p>";
                                                }
                                            } else {
                                                echo "Erro na execução da query: " . print_r($result_avaliacoes->errorInfo(), true);
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            }
        ?>
        <?php 
            while($row_cursos = mysqli_fetch_assoc($resultado_curso)){   
        ?>
        <!-- Menu lateral -->
        <div id="sideMenu">
            <!-- botão de fechar -->
            <button id="closeMenu">X</button>
            <!-- parte de cima com imagem, titulo, descrição, etc. -->
            <div class="menulateralquadrado">
                <!-- imagem -->
                <div class="menulateralquadradoimagem">
                    <img src="../../COMUM/img/cursos/capa_dos_cursos/<?php echo $row_cursos['imagem'] ?>">
                </div>
                <!-- Nome do curso -->
                <div class="menulateralquadradotexto">
                    <div class="menulateralquadradotextotitulo">
                        <?php echo $row_cursos['Nome']; ?>
                    </div>
                    <!-- linha embaixo do nome -->
                    <hr class="linha">
                    <!-- descrição -->
                    <div class="menulateralquadradotextodescricao">
                        <?php echo substr($row_cursos['Descricao'], 0, 200) . '...';?>
                    </div>
                    <!-- parte pequena onde tem a carga horária e o botão ver aulas  -->
                    <div class="menulateralquadradotextoopcoes">
                        <!-- Carga horária -->
                        <div class="menulateralquadradotextoopcoesquantidadem">
                            Carga horária: <?php echo $row_cursos['Carga_horaria']; ?> horas
                        </div>
                        <!-- Ver aulas -->
                        <div class="menulateralquadradotextoopcoesveraulas">
                            Inscritos: <?php echo $row_cursos['inscritos']; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- espaço onde fica a pesquisa-->
            <!--<div class="menulateralpesquisa">
                 campo de pesquisa -->
                <!--<div class="barradebuscadetalhes">
                    <input type="text" name="pesquisadetalhes" class="pesquisadetalhes" id="pesquisadetalhes" placeholder="Digitar...">
                </div>-->
                    <!-- botão da pesquisa-->
                    <!--<div class="botaobuscadetalhes">
                        <button type="submit" class="lupadetalhes" onclick="return preencherCategoria()">
                            <img src="../../COMUM/img/cursos/imagens/loupe.png">
                        </button>
                    </div>
                </div>-->

            <!-- aqui é onde ficam os módulos -->
            <div class="menulateralaulas">
                <div class="modulodetalhes" id="modulodetalhes">
                    <?php
                        // Recupere as aulas e módulos do curso no BD
                        $query_aulas = "SELECT aul.id id_aul, aul.titulo, aul.ordem,
                        mdu.id id_mdu, mdu.nome nome_mdu
                        FROM aulas aul 
                        INNER JOIN modulos AS mdu ON mdu.id = aul.modulo_id 
                        WHERE mdu.curso_id=:curso_id 
                        ORDER BY mdu.ordem, aul.ordem ASC";
                        $result_aulas = $con->prepare($query_aulas);
                        $result_aulas->bindParam(':curso_id', $curso_id);
                        $result_aulas->execute();

                        // Consulta para contar o número total de aulas por módulo
                        $query_count_aulas = "SELECT modulo_id, COUNT(*) as total_aulas FROM aulas WHERE modulo_id IN (SELECT id FROM modulos WHERE curso_id=:curso_id) GROUP BY modulo_id";
                        $stmt_count_aulas = $con->prepare($query_count_aulas);
                        $stmt_count_aulas->bindParam(':curso_id', $curso_id);
                        $stmt_count_aulas->execute();
                        $count_aulas_por_modulo = array();

                        // Use um loop para exibir os módulos e aulas
                        if (($result_aulas) and ($result_aulas->rowCount() != 0)) {
                            $modulo_anterior = null;
                            $num_aulas_modulo = 0; // Contador de aulas para o módulo atual

                            while ($row_count_aulas = $stmt_count_aulas->fetch(PDO::FETCH_ASSOC)) {
                                $count_aulas_por_modulo[$row_count_aulas['modulo_id']] = $row_count_aulas['total_aulas'];
                            }
                            
                            $modulo_anterior = null;

                            while ($row_aula = $result_aulas->fetch(PDO::FETCH_ASSOC)) {
                                extract($row_aula);
                                $titulo = substr($row_aula['titulo'], 0, 15) . '...';

                                if ($modulo_anterior !== $id_mdu) {
                                    if (!is_null($modulo_anterior)) {                         
                                        echo "</div>";
                                    }

                                    echo "<div class='modulo'>
                                            <h5>Nome do módulo: $nome_mdu</h5>
                                            <div class='fundo-transparente'>
                                                <img class='seta' src='../../COMUM/img/cursos/imagens/arrowright.png' width='30' height='30'>
                                                <div class='num-aulas'>Aulas: ";
                                            // Exibe o número total de aulas no módulo atual
                                            echo isset($count_aulas_por_modulo[$id_mdu]) ? $count_aulas_por_modulo[$id_mdu] : 0;

                                        echo "      </div>
                                                </div>
                                            </div>";
                                    echo "<div class='aulas' style='display: none'>";
                                }

                                // Verifica se a aula está cadastrada na tabela progresso_aula
                                $query_progresso = "SELECT * FROM progresso_aula WHERE id_usuario = $id_user AND id_aula = $id_aul";
                                $resultado_progresso = mysqli_query($conn, $query_progresso);

                                if ($resultado_progresso) {
                                    $registro_progresso = mysqli_fetch_assoc($resultado_progresso);

                                    if ($registro_progresso) {
                                        // Se houver um registro, a aula já foi iniciada
                                        if ($registro_progresso['concluida']) {
                                            // Se a aula foi concluída, exibir o botão "Finalizado"
                                            echo "<div class='aula'>
                                                    <div class='aula-inner'>
                                                        <p class='aula-titulo'>Aulas: $ordem | Título: $titulo | <a class='botaodetalhes' href='visualizar_aula.php?id_usuario=$id_user&id=$id_aul&modulo_id=$id_mdu&curso_id=$curso_id&ordem=$ordem'>Concluído</a> | Status: <font color= green> Concluído </font>
                                                    </div>
                                                </div>";
                                        } else {
                                            // Se a aula está em andamento, exibir o botão "Continuar"
                                            echo "<div class='aula'>
                                                    <div class='aula-inner'>
                                                        <p class='aula-titulo'>Aulas: $ordem | Título: $titulo | <a class='botaodetalhes' href='visualizar_aula.php?id_usuario=$id_user&id=$id_aul&modulo_id=$id_mdu&curso_id=$curso_id&ordem=$ordem'>Continuar</a> | Status: <font color=#4169e1> Em andamento </font> </p>
                                                    </div>
                                                </div>";
                                        }
                                    } else {
                                        // Se não houver registro, a aula ainda não foi iniciada
                                        // Exibir o botão "Começar"
                                        echo "<div class='aula'>
                                                <div class='aula-inner'>
                                                    <p class='aula-titulo'>Aulas: $ordem | Título: $titulo | <a class='botaodetalhes' href='php/iniciar_aula.php?id_usuario=$id_user&id_aula=$id_aul&modulo_id=$id_mdu&curso_id=$curso_id&ordem=$ordem'>Começar</a> | Status: <font color= red> Não iniciado </font> 
                                                </div>
                                            </div>";
                                    }
                                } else {
                                    // Trate o erro, se houver algum
                                    echo "Erro na consulta: " . mysqli_error($conn);
                                }

                                $modulo_anterior = $id_mdu;
                            }

                            // Adiciona o texto para o último módulo
                            //echo "<div class='num-aulas'>Aulas: $num_aulas_modulo</div>";
                            // Fecha o último contêiner das aulas
                                if (!is_null($modulo_anterior)) {
                                    echo "</div>";
                                }
                            //echo "</div>"; // Fecha o contêiner do último módulo
                            echo "</div>"; // Fecha o contêiner geral
                        } else {
                            echo "<p style='color: #f00;'>Erro: Nenhuma aula encontrada!</p>";
                        }
                    ?>
                </div>
            </div>
        </div>
        <div id="confirmacao-overlay"></div>
        <div id="confirmacao-pop-up">
            <p>Tem certeza que deseja enviar suas respostas?</p>
            <button id="confirmar-sim">Sim</button>
            <button id="confirmar-nao">Não</button>
        </div>

        <?php 
            }
            //rodapé
            require "rodape.php"; 
        ?>
        <!-- javascript -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let currentQuestionIndex = 0;
                const questions = document.querySelectorAll('.questao');
                const totalQuestions = questions.length;

                function showQuestion(index) {
                    questions.forEach((question, i) => {
                        question.style.display = i === index ? 'block' : 'none';
                    });
                }

                function navigateQuestion(step) {
                    const newIndex = currentQuestionIndex + step;
                    if (newIndex >= 0 && newIndex < totalQuestions) {
                        if (questions[newIndex].dataset.inscrito === "true") {
                            currentQuestionIndex = newIndex;
                            showQuestion(currentQuestionIndex);
                        } else {
                            alert(`Você não está inscrito na aula ${step > 0 ? 'próxima' : 'anterior'}.`);
                        }
                    }
                }

                questions.forEach((question, index) => {
                    const nextButton = question.querySelector('.proxima');
                    const previousButton = question.querySelector('.anterior');

                    if (nextButton) {
                        nextButton.addEventListener('click', function() {
                            navigateQuestion(1);
                        });
                    }

                    if (previousButton) {
                        previousButton.addEventListener('click', function() {
                            navigateQuestion(-1);
                        });
                    }

                    question.querySelectorAll('input[type="radio"]').forEach(radio => {
                        radio.addEventListener('change', function() {
                            nextButton.click();
                        });
                    });
                });

                // Mostrar confirmação de envio
                const enviarProvaBtn = document.getElementById('enviar-prova-btn');
                const confirmacaoOverlay = document.getElementById('confirmacao-overlay');
                const confirmacaoPopUp = document.getElementById('confirmacao-pop-up');
                const enviarProvaForm = document.getElementById('form-prova');

                if (enviarProvaBtn) {
                    enviarProvaBtn.addEventListener('click', function () {
                        if (confirmacaoOverlay && confirmacaoPopUp) {
                            confirmacaoOverlay.style.display = 'block';
                            confirmacaoPopUp.style.display = 'block';
                        }
                    });
                }

                const confirmarSimBtn = document.getElementById('confirmar-sim');
                const confirmarNaoBtn = document.getElementById('confirmar-nao');

                if (confirmarSimBtn) {
                    confirmarSimBtn.addEventListener('click', function () {
                        if (confirmacaoOverlay && confirmacaoPopUp) {
                            confirmacaoOverlay.style.display = 'none';
                            confirmacaoPopUp.style.display = 'none';
                        }
                        if (enviarProvaForm) {
                            enviarProvaForm.submit();
                        }
                    });
                }

                if (confirmarNaoBtn) {
                    confirmarNaoBtn.addEventListener('click', function () {
                        if (confirmacaoOverlay && confirmacaoPopUp) {
                            confirmacaoOverlay.style.display = 'none';
                            confirmacaoPopUp.style.display = 'none';
                        }
                    });
                }

                showQuestion(currentQuestionIndex);
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
        <!--<script src="js/darkmode.js"></script>-->
        <script src="js/zoom.js"></script>
        <script src="js/tablist.js"></script>
        <script src="js/menulateral.js"></script>
        <script src="js/modulos.js"></script>
    </body>
</html>