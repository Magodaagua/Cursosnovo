<?php
    include_once("conexao.php");
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL);

    $id_user = isset($_POST['id_user']) ? $_POST['id_user'] : null;

    $stmt = $conn->prepare("SELECT id_user_envio FROM mensagens_zap WHERE id_user_recebe = ? AND (mensagem_lida IS NULL OR mensagem_lida = 0) GROUP BY id_user_envio");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $novasMensagens = [];
    while ($row = $resultado->fetch_assoc()) {
        $novasMensagens[] = [
            'id_contato' => $row['id_user_envio']
        ];
    }

    $response = array(
        'haNovasMensagens' => count($novasMensagens) > 0,
        'novasMensagens' => $novasMensagens
    );

    header('Content-Type: application/json');
    echo json_encode($response);
?>
