<?php
    include_once("conexao.php");
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL);

    $id_user = isset($_POST['id_user']) ? $_POST['id_user'] : null;
    $id_contato = isset($_POST['id_contato']) ? $_POST['id_contato'] : null;
    $ultimaDataHora = isset($_POST['ultimaDataHora']) ? $_POST['ultimaDataHora'] : '0000-00-00 00:00:00';

    $stmt = $conn->prepare("SELECT id_mensagem, mensagem, arquivo, data_hora, id_user_envio FROM mensagens_zap WHERE ((id_user_envio = ? AND id_user_recebe = ?) OR (id_user_envio = ? AND id_user_recebe = ?)) AND data_hora > ? ORDER BY data_hora ASC");
    $stmt->bind_param("iiiss", $id_user, $id_contato, $id_contato, $id_user, $ultimaDataHora);
    $stmt->execute();
    $resultado_mensagens = $stmt->get_result();

    $mensagens = '';
    $ultima_mensagem_data_hora = null;
    while ($row_mensagem = $resultado_mensagens->fetch_assoc()) {
        // Verifica se o usuário que enviou a mensagem já está na lista de contatos
        $stmt2 = $conn->prepare("SELECT * FROM contatos WHERE id_user_dono = ? AND id_user_contato = ?");
        $stmt2->bind_param("ii", $id_user, $row_mensagem['id_user_envio']);
        $stmt2->execute();
        $result = $stmt2->get_result();

        // Se o usuário que enviou a mensagem não está na lista de contatos, adiciona-o automaticamente
        if ($result->num_rows == 0) {
            $stmt3 = $conn->prepare("INSERT INTO contatos (id_user_dono, id_user_contato) VALUES (?, ?)");
            $stmt3->bind_param("ii", $id_user, $row_mensagem['id_user_envio']);
            if ($stmt3->execute()) {
                error_log("Contato inserido com sucesso: $id_user -> {$row_mensagem['id_user_envio']}");
            } else {
                error_log("Erro ao inserir contato: " . $stmt3->error);
            }
        }

        // Atualize o status de leitura da mensagem
        $id_mensagem = $row_mensagem['id_mensagem'];
        $update_query = mysqli_query($conn, "UPDATE mensagens_zap SET mensagem_lida = 1 WHERE id_mensagem = '$id_mensagem' AND id_user_recebe = '$id_user'");
        if (!$update_query) {
            $response['updateStatus'] = "Erro ao atualizar registro: " . mysqli_error($conn);
        } else {
            $response['updateStatus'] = "Registro atualizado com sucesso";
        }

        $mensagem = htmlspecialchars($row_mensagem['mensagem']);
        $arquivo = htmlspecialchars($row_mensagem['arquivo']);
        $data_hora = $row_mensagem['data_hora'] ? date_format(date_create($row_mensagem['data_hora']), 'd-m-Y H:i') : '';
        $id_user_envio = $row_mensagem['id_user_envio'];

        if ($id_user_envio == $id_user) {
            $mensagens .= '<div class="mensagem enviada">';
        } else {
            $mensagens .= '<div class="mensagem recebida">';
        }

        $mensagens .= '    <div class="conteudo_mensagem">';
        if ($arquivo) {
            $extensao = pathinfo($arquivo, PATHINFO_EXTENSION);
            $nome_arquivo = pathinfo($arquivo, PATHINFO_BASENAME);

            // Ordena os IDs do usuário e do contato para que o menor sempre venha primeiro
            $ids = array($id_user, $id_contato);
            sort($ids);

            $upload_dir = "../../../COPIZAP/IMAGEM/UPLOADS/{$ids[0]}-{$ids[1]}/";
            $file_path = $upload_dir . $nome_arquivo;

            if (in_array($extensao, ['jpg', 'jpeg', 'png', 'gif'])) {
                $mensagens .= '<img src="'.$file_path.'" alt="Imagem enviada" />';
            } elseif (in_array($extensao, ['mp4', 'mkv'])) {
                $mensagens .= '<video controls><source src="'.$file_path.'" type="video/'.$extensao.'"></video>';
            } elseif (in_array($extensao, ['mp3', 'wav'])) {
                $mensagens .= '<audio controls><source src="'.$file_path.'" type="audio/'.$extensao.'"></audio>';
            } else {
                $mensagens .= '<a href="'.$file_path.'">'.$nome_arquivo.'</a>';
            }
            $mensagens .= '<br/>';
        } //else {
            $mensagens .= $mensagem;
        //}

        $mensagens .= '    </div>';
        $mensagens .= '    <div class="data_mensagem">'.$data_hora.'</div>';
        $mensagens .= '</div>';

        $ultima_mensagem_data_hora = $row_mensagem['data_hora'];
    }

    $haNovasMensagens = $ultima_mensagem_data_hora > $ultimaDataHora;

    $response = array(
        'mensagens' => $mensagens,
        'ultimaDataHora' => $ultima_mensagem_data_hora,
        'haNovasMensagens' => $haNovasMensagens
    );

    header('Content-Type: application/json');
    echo json_encode($response);
?>
