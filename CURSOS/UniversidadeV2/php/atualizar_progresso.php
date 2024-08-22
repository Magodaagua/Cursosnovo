<?php
    // Inclua a conexão com o banco de dados
    include_once "conexao.php"; // Certifique-se de ajustar o caminho do arquivo de conexão conforme necessário
    // Recupere os parâmetros da página atual
    $id_usuario = filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_NUMBER_INT);
    $id_curso = filter_input(INPUT_POST, 'id_curso', FILTER_SANITIZE_NUMBER_INT);
    $id_modulo = filter_input(INPUT_POST, 'modulo_id', FILTER_SANITIZE_NUMBER_INT);
    $id_aula = filter_input(INPUT_POST, 'id_aula', FILTER_SANITIZE_NUMBER_INT);
    $porcentagem = filter_input(INPUT_POST, 'porcentagem', FILTER_SANITIZE_NUMBER_FLOAT);

    // Atualize o campo 'concluida' para 1 na tabela progresso_aula
    $query_update = "UPDATE progresso_aula SET concluida = 1 WHERE id_usuario = :id_usuario AND id_aula = :id_aula AND id_curso = :id_curso";
    $stmt_update = $con->prepare($query_update);
    $stmt_update->bindParam(':id_usuario', $id_usuario);
    $stmt_update->bindParam(':id_aula', $id_aula);
    $stmt_update->bindParam(':id_curso', $id_curso);
    $stmt_update->execute();

    // Recupera a ordem da aula atual
    $query_ordem_atual = "SELECT ordem FROM aulas WHERE id = :id_aula";
    $stmt_ordem_atual = $con->prepare($query_ordem_atual);
    $stmt_ordem_atual->bindParam(':id_aula', $id_aula);
    $stmt_ordem_atual->execute();
    $ordem = $stmt_ordem_atual->fetchColumn();

    // Calcular a ordem da próxima aula
    $ordemSeguinte = $ordem + 1;

    // Consulta para verificar se a próxima aula existe no mesmo módulo e curso
    $querySeguinte = "SELECT aulas.id, aulas.ordem 
                    FROM aulas 
                    INNER JOIN modulos ON aulas.modulo_id = modulos.id 
                    WHERE aulas.ordem = :ordemSeguinte AND modulos.id = :modulo_id AND modulos.curso_id = :curso_id";
    $stmtSeguinte = $con->prepare($querySeguinte);
    $stmtSeguinte->bindParam(':ordemSeguinte', $ordemSeguinte);
    $stmtSeguinte->bindParam(':modulo_id', $id_modulo);
    $stmtSeguinte->bindParam(':curso_id', $id_curso);
    $stmtSeguinte->execute();

    if ($stmtSeguinte->rowCount() > 0) {
        $aulaSeguinte = $stmtSeguinte->fetch(PDO::FETCH_ASSOC);
        $idAulaseguinte = $aulaSeguinte['id'];
        $ordemSeguinte = $aulaSeguinte['ordem'];

        // Inscrever automaticamente o usuário na próxima aula se ainda não estiver inscrito
        $query_verificar_inscricao = "SELECT * FROM progresso_aula WHERE id_usuario = :id_usuario AND id_aula = :id_aula";
        $stmt_verificar_inscricao = $con->prepare($query_verificar_inscricao);
        $stmt_verificar_inscricao->bindParam(':id_usuario', $id_usuario);
        $stmt_verificar_inscricao->bindParam(':id_aula', $idAulaseguinte);
        $stmt_verificar_inscricao->execute();

        if ($stmt_verificar_inscricao->rowCount() == 0) {
            $query_inscrever = "INSERT INTO progresso_aula (id_usuario, id_aula, id_curso, concluida) VALUES (:id_usuario, :id_aula, :id_curso, 0)";
            $stmt_inscrever = $con->prepare($query_inscrever);
            $stmt_inscrever->bindParam(':id_usuario', $id_usuario);
            $stmt_inscrever->bindParam(':id_aula', $idAulaseguinte);
            $stmt_inscrever->bindParam(':id_curso', $id_curso);
            $stmt_inscrever->execute();
        }

        header("Location: ../visualizar_aula.php?id_user=$id_usuario&id=$idAulaseguinte&modulo_id=$id_modulo&curso_id=$id_curso&ordem=$ordemSeguinte");
    } else {
        // Caso não haja próxima aula, redireciona para a aula atual ou uma página de conclusão do curso
        header("Location: ../visualizar_aula.php?id_user=$id_usuario&id=$id_aula&modulo_id=$id_modulo&curso_id=$id_curso&ordem=$ordem");
    }
    exit();
?>
