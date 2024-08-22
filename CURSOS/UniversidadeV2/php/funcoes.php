<?php
    function atualizarStatusOnline($id_usuario, $status) {
        // Conecte-se ao banco de dados (use suas credenciais)
        $conexao = new mysqli('192.168.1.10', 'DevUser2', 'BV!A2k1$e61ms#yeQpE4j', 'DevPortalCop');

        // Verifique a conexão
        if ($conexao->connect_error) {
            die("Conexão falhou: " . $conexao->connect_error);
        }

        // Prepare e execute a query de atualização
        $sql = "UPDATE usuario SET status_online = ? WHERE ID_usuario = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ii", $status, $id_usuario);

        $stmt->execute();
        $stmt->close();
        $conexao->close();
        
        return true;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_usuario = $_POST['id_usuario'];
        $status = $_POST['status'];
        
        if (atualizarStatusOnline($id_usuario, $status)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
    function gerarListaDeContatosRecentes($conn, $id_user) {
        $result_contatos = "
            SELECT usuario.ID_usuario, usuario.Nome, usuario.FotoPerfil, usuario.Dep, usuario.status_online, mensagens_zap.arquivo, mensagens_zap.mensagem AS ultima_mensagem, mensagens_zap.data_hora AS hora_ultima_mensagem
            FROM usuario
            JOIN contatos ON usuario.ID_usuario = contatos.id_user_contato
            LEFT JOIN mensagens_zap ON mensagens_zap.data_hora = (
                SELECT MAX(m.data_hora)
                FROM mensagens_zap m
                WHERE (m.id_user_envio = usuario.ID_usuario AND m.id_user_recebe = '$id_user')
                    OR (m.id_user_envio = '$id_user' AND m.id_user_recebe = usuario.ID_usuario)
            )
            WHERE contatos.id_user_dono = '$id_user'
            AND mensagens_zap.data_hora IS NOT NULL
            AND mensagens_zap.data_hora >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)
            GROUP BY usuario.ID_usuario
            ORDER BY hora_ultima_mensagem DESC
            LIMIT 10
        ";

        if (!$resultado_contatos = mysqli_query($conn, $result_contatos)) {
            return "Erro ao executar a consulta: " . mysqli_error($conn);
        }

        return gerarListaHTML($resultado_contatos);
    }

    function gerarListaDeTodosContatos($conn, $id_user) {
        $result_contatos = "
            SELECT usuario.ID_usuario, usuario.Nome, usuario.FotoPerfil, usuario.status_online, usuario.Dep, mensagens_zap.arquivo, mensagens_zap.mensagem AS ultima_mensagem, mensagens_zap.data_hora AS hora_ultima_mensagem
            FROM usuario
            JOIN contatos ON usuario.ID_usuario = contatos.id_user_contato
            LEFT JOIN mensagens_zap ON mensagens_zap.id_mensagem = (
                SELECT MAX(m.id_mensagem)
                FROM mensagens_zap m
                WHERE (m.id_user_envio = usuario.ID_usuario AND m.id_user_recebe = '$id_user')
                    OR (m.id_user_envio = '$id_user' AND m.id_user_recebe = usuario.ID_usuario)
            )
            WHERE contatos.id_user_dono = '$id_user'
            GROUP BY usuario.ID_usuario
            ORDER BY hora_ultima_mensagem DESC
        ";

        if (!$resultado_contatos = mysqli_query($conn, $result_contatos)) {
            return "Erro ao executar a consulta: " . mysqli_error($conn);
        }

        if (mysqli_num_rows($resultado_contatos) == 0) {
            return "Nenhum contato encontrado para todos.";
        }

        return gerarListaHTML($resultado_contatos);
    }

    function gerarListaHTML($resultado_contatos) {
        $lista_de_contatos = '';
    
        while ($row_contatos = mysqli_fetch_assoc($resultado_contatos)) {
            $nome_contato = $row_contatos['Nome'] ? htmlspecialchars(substr($row_contatos['Nome'], 0, 18)) : '';
            $foto_contato = htmlspecialchars($row_contatos['FotoPerfil']);
            $id_contato = $row_contatos['ID_usuario'];
            $arquivo = isset($row_contatos['arquivo']) ? $row_contatos['arquivo'] : '';
            $dep_contato = isset($row_contatos['Dep']) ? $row_contatos['Dep'] : '';
            $status_online = $row_contatos['status_online'] == 1 ? 'green' : 'red';
    
            if ($arquivo) {
                $extensao = pathinfo($arquivo, PATHINFO_EXTENSION);
                if (in_array($extensao, ['jpg', 'jpeg', 'png', 'gif'])) {
                    $ultima_mensagem = 'Imagem recebida';
                } elseif (in_array($extensao, ['mp4', 'mkv'])) {
                    $ultima_mensagem = 'Vídeo recebido';
                } elseif (in_array($extensao, ['mp3', 'wav'])) {
                    $ultima_mensagem = 'Áudio recebido';
                } else {
                    $ultima_mensagem = 'Arquivo recebido';
                }
            } else {
                $ultima_mensagem = $row_contatos['ultima_mensagem'] ? htmlspecialchars(mb_substr($row_contatos['ultima_mensagem'], 0, 20, 'UTF-8'), ENT_QUOTES, 'UTF-8') : '';
    
                $ultimoCaractere = mb_substr($ultima_mensagem, -1, null, 'UTF-8');
                if (!mb_check_encoding($ultimoCaractere, 'UTF-8')) {
                    $ultima_mensagem = mb_substr($ultima_mensagem, 0, -1, 'UTF-8');
                }
            }
    
            $hora_ultima_mensagem = $row_contatos['hora_ultima_mensagem'] ? date_format(date_create($row_contatos['hora_ultima_mensagem']), 'd-m-Y H:i') : '';        
    
            $lista_de_contatos .= '
                <div class="retangulocontato contato" data-id-contato-unico="' . $id_contato . '">
                    <div class="contatoimagem" style="position: relative;">
                        <img src="../../COMUM/img/Funcionarios/' . $foto_contato . '" alt="Foto do Contato">
                        <div class="status-indicator" style="background-color: ' . $status_online . ';"></div>
                    </div>
                    <div class="contato_information">
                        <p class="contato_nome">' . $nome_contato . '</p>
                        <p class="contato_dep">' . $dep_contato . '</p>
                        <p class="contato_ultima">' . $ultima_mensagem . '</p>
                    </div>
                    <div class="data_ultima_mensagem">' . $hora_ultima_mensagem . '</div>
                </div>
            ';
        }
    
        return $lista_de_contatos;
    }    
    
?>
