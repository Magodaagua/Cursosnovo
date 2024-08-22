<?php
    include_once("conexao.php");
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL);

    $id_user = isset($_POST['id_user']) ? $_POST['id_user'] : null;
    $id_contato = isset($_POST['id_contato']) ? $_POST['id_contato'] : null;
    $ultimaDataHora = isset($_POST['ultimaDataHora']) ? $_POST['ultimaDataHora'] : '0000-00-00 00:00:00';

    $response = array();

    if (!$id_user || !$id_contato) {
        $response['error'] = 'Tipo de contato não especificado.';
        echo json_encode($response);
        exit;
    }

    $stmt = $conn->prepare("SELECT id_mensagem, id_user_envio, id_user_recebe, mensagem, arquivo, data_hora FROM mensagens_zap WHERE ((id_user_envio = ? AND id_user_recebe = ?) OR (id_user_envio = ? AND id_user_recebe = ?)) AND data_hora > ? ORDER BY data_hora ASC");
    $stmt->bind_param("iiiss", $id_user, $id_contato, $id_contato, $id_user, $ultimaDataHora);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        $response['error'] = 'Erro ao executar a consulta: ' . $conn->error;
        echo json_encode($response);
        exit;
    }

    $response['mensagens'] = array();
    $ultima_mensagem_data_hora = null;
    while ($row = $result->fetch_assoc()) {
        // Atualize o status de leitura da mensagem para 'lida' se for recebida pelo usuário atual
        if ($row['id_user_recebe'] == $id_user) {
            $id_mensagem = $row['id_mensagem'];
            $update_stmt = $conn->prepare("UPDATE mensagens_zap SET mensagem_lida = 1 WHERE id_mensagem = ? AND id_user_recebe = ?");
            $update_stmt->bind_param("ii", $id_mensagem, $id_user);
            $update_stmt->execute();
        }

        $mensagem = htmlspecialchars($row['mensagem']);
        $arquivo = htmlspecialchars($row['arquivo']);
        $data_hora = $row['data_hora'];
        $id_user_envio = $row['id_user_envio'];

        $response['mensagens'][] = array(
            'id_mensagem' => $row['id_mensagem'],
            'id_user_envio' => $id_user_envio,
            'id_user_recebe' => $row['id_user_recebe'],
            'mensagem' => $mensagem,
            'arquivo' => $arquivo,
            'data_hora' => $data_hora
        );

        $ultima_mensagem_data_hora = $row['data_hora'];
    }

    $haNovasMensagens = $ultima_mensagem_data_hora > $ultimaDataHora;

    $response['ultimaDataHora'] = $ultima_mensagem_data_hora;
    $response['haNovasMensagens'] = $haNovasMensagens;

    header('Content-Type: application/json');
    echo json_encode($response);
?>
