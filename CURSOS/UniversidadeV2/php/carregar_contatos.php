<?php
    include_once("conexao.php");
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;
    $id_user = isset($_POST['id_user']) ? $_POST['id_user'] : null;

    if ($id_user) {
        if ($tipo == 'recentes') {
            $query = "
                SELECT 
                    c.id, 
                    c.id_user_dono, 
                    c.id_user_contato, 
                    u.Nome as nome, 
                    u.Dep as departamento, 
                    u.FotoPerfil as imagem, 
                    u.status_online,  -- Adicione esta linha
                    subquery.ultima_interacao, 
                    SUBSTRING(subquery.mensagem, 1, 150) as ultima_mensagem
                FROM 
                    contatos c
                JOIN 
                    usuario u ON c.id_user_contato = u.ID_usuario
                JOIN (
                    SELECT 
                        mz1.id_user_envio, 
                        mz1.id_user_recebe, 
                        mz1.mensagem, 
                        mz1.data_hora as ultima_interacao
                    FROM 
                        mensagens_zap mz1
                    WHERE 
                        mz1.data_hora = (
                            SELECT MAX(mz2.data_hora)
                            FROM mensagens_zap mz2
                            WHERE 
                                (mz2.id_user_envio = mz1.id_user_envio AND mz2.id_user_recebe = mz1.id_user_recebe)
                                OR 
                                (mz2.id_user_envio = mz1.id_user_recebe AND mz2.id_user_recebe = mz1.id_user_envio)
                        )
                ) subquery 
                ON 
                    (c.id_user_dono = subquery.id_user_envio AND c.id_user_contato = subquery.id_user_recebe) 
                    OR 
                    (c.id_user_dono = subquery.id_user_recebe AND c.id_user_contato = subquery.id_user_envio)
                WHERE 
                    c.id_user_dono = ?
                GROUP BY 
                    c.id_user_contato
                ORDER BY 
                    subquery.ultima_interacao DESC
                LIMIT 10
            ";
        } else if ($tipo == 'todos') {
            $query = "
                SELECT 
                    c.id, 
                    c.id_user_dono, 
                    c.id_user_contato, 
                    u.Nome as nome, 
                    u.Dep as departamento, 
                    u.FotoPerfil as imagem, 
                    u.status_online,  -- Adicione esta linha
                    NULL as ultima_interacao, 
                    NULL as ultima_mensagem
                FROM 
                    contatos c
                JOIN 
                    usuario u ON c.id_user_contato = u.ID_usuario
                WHERE 
                    c.id_user_dono = ?
            ";
        } else {
            echo json_encode(['error' => 'Tipo de contato não especificado.']);
            exit;
        }

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();

        $contatos = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data_formatada = isset($row['ultima_interacao']) ? date('d/m/Y', strtotime($row['ultima_interacao'])) : null;
                $contatos[] = [
                    'id' => $row['id_user_contato'],
                    'nome' => $row['nome'],
                    'departamento' => $row['departamento'],
                    'imagem' => $row['imagem'],
                    'status_online' => $row['status_online'],  // Adicione esta linha
                    'ultima_interacao' => $data_formatada,
                    'ultima_mensagem' => $row['ultima_mensagem']
                ];
            }
        }

        header('Content-Type: application/json');
        echo json_encode(['contatos' => $contatos]);
    } else {
        echo json_encode(['error' => 'ID do usuário não fornecido.']);
    }
?>
