<?php
    include_once("conexao.php");

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Receber os dados do formulário
    $id_user = filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_NUMBER_INT);
    $prova_id = filter_input(INPUT_POST, 'prova_id', FILTER_SANITIZE_NUMBER_INT);
    $modulo_id = filter_input(INPUT_POST, 'modulo_id', FILTER_SANITIZE_NUMBER_INT);
    $curso_id = filter_input(INPUT_POST, 'curso_id', FILTER_SANITIZE_NUMBER_INT);
    $ordem = filter_input(INPUT_POST, 'ordem', FILTER_SANITIZE_NUMBER_INT);
    $aula_id = filter_input(INPUT_POST, 'aula_id', FILTER_SANITIZE_NUMBER_INT);
    $respostas = filter_input(INPUT_POST, 'resposta', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

    // Inicializar variáveis
    $acertos = 0;
    $total_questoes = count($respostas);

    // Calcular a quantidade de acertos
    foreach ($respostas as $questao_id => $resposta) {
        $query = "SELECT resposta_certa FROM questoes WHERE id = :questao_id";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':questao_id', $questao_id, PDO::PARAM_INT);
        $stmt->execute();
        $resposta_certa = $stmt->fetchColumn();
        
        if ($resposta_certa === $resposta) {
            $acertos++;
        }
    }
    
    // Calcular a porcentagem de acertos
    $nota = ($acertos / $total_questoes) * 100;
    
    // Verificar se o usuário já fez a prova
    $query_prova_feita = "SELECT tentativas FROM provafeita WHERE prova_id = :prova_id AND usuario_id = :usuario_id LIMIT 1";
    $stmt_prova_feita = $con->prepare($query_prova_feita);
    $stmt_prova_feita->bindParam(':prova_id', $prova_id, PDO::PARAM_INT);
    $stmt_prova_feita->bindParam(':usuario_id', $id_user, PDO::PARAM_INT);
    $stmt_prova_feita->execute();
    $prova_feita = $stmt_prova_feita->fetch(PDO::FETCH_ASSOC);
    
    if ($prova_feita) {
        // Incrementar tentativas
        $tentativas = $prova_feita['tentativas'] + 1;
    
        // Atualizar a tabela provafeita com a nova tentativa
        $query = "UPDATE provafeita SET respostas = :respostas, nota = :nota, acertos = :acertos, total_questoes = :total_questoes, tentativas = :tentativas WHERE prova_id = :prova_id AND usuario_id = :usuario_id";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':respostas', json_encode($respostas), PDO::PARAM_STR);
        $stmt->bindParam(':nota', $nota, PDO::PARAM_INT);
        $stmt->bindParam(':acertos', $acertos, PDO::PARAM_INT);
        $stmt->bindParam(':total_questoes', $total_questoes, PDO::PARAM_INT);
        $stmt->bindParam(':tentativas', $tentativas, PDO::PARAM_INT);
        $stmt->bindParam(':prova_id', $prova_id, PDO::PARAM_INT);
        $stmt->bindParam(':usuario_id', $id_user, PDO::PARAM_INT);
    
        // Se a segunda tentativa também falhar, mudar tentativas para 3
        if ($tentativas == 2 && $nota < 70) {
            $tentativas = 3;
            $query = "UPDATE provafeita SET tentativas = 3 WHERE prova_id = :prova_id AND usuario_id = :usuario_id";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':prova_id', $prova_id, PDO::PARAM_INT);
            $stmt->bindParam(':usuario_id', $id_user, PDO::PARAM_INT);
            $stmt->execute();
        } elseif ($tentativas == 3 && $nota < 70) {
            $tentativas = 4;
            $query = "UPDATE provafeita SET tentativas = 4 WHERE prova_id = :prova_id AND usuario_id = :usuario_id";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':prova_id', $prova_id, PDO::PARAM_INT);
            $stmt->bindParam(':usuario_id', $id_user, PDO::PARAM_INT);
            $stmt->execute();
        }
    } else {
        // Primeira tentativa
        $tentativas = 1;
    
        // Inserir os dados na tabela provafeita
        $query = "INSERT INTO provafeita (prova_id, usuario_id, respostas, nota, acertos, total_questoes, tentativas) VALUES (:prova_id, :usuario_id, :respostas, :nota, :acertos, :total_questoes, :tentativas)";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':prova_id', $prova_id, PDO::PARAM_INT);
        $stmt->bindParam(':usuario_id', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':respostas', json_encode($respostas), PDO::PARAM_STR);
        $stmt->bindParam(':nota', $nota, PDO::PARAM_INT);
        $stmt->bindParam(':acertos', $acertos, PDO::PARAM_INT);
        $stmt->bindParam(':total_questoes', $total_questoes, PDO::PARAM_INT);
        $stmt->bindParam(':tentativas', $tentativas, PDO::PARAM_INT);
    }
    
    $stmt->execute();
    
    // Atualizar o status da prova na tabela progresso_aula se a nota for 70% ou mais
    if ($nota >= 70) {
        $query_progresso = "UPDATE progresso_aula SET concluida = 1 WHERE id_usuario = :id_user AND id_aula = :aula_id AND id_curso = :curso_id";
        $stmt_progresso = $con->prepare($query_progresso);
        $stmt_progresso->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt_progresso->bindParam(':aula_id', $aula_id, PDO::PARAM_INT);
        $stmt_progresso->bindParam(':curso_id', $curso_id, PDO::PARAM_INT);
        $stmt_progresso->execute();
    }
    
    // Redirecionar para a página de visualização da aula com a nota e acertos
    header("Location: ../visualizar_aula.php?id=$aula_id&id_user=$id_user&modulo_id=$modulo_id&curso_id=$curso_id&ordem=$ordem&finalizada=1&nota=$nota&acertos=$acertos&total_questoes=$total_questoes&tentativas=$tentativas");
    exit();
?>
        