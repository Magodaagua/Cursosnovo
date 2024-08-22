<?php
    include_once("conexao.php");
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    date_default_timezone_set('America/Sao_Paulo');

    $id_user = isset($_POST['id_user']) ? $_POST['id_user'] : null;
    $id_contato = isset($_POST['id_contato']) ? $_POST['id_contato'] : null;
    $mensagem = isset($_POST['mensagem']) ? $_POST['mensagem'] : null;
    $data_hora = date('Y-m-d H:i:s');

    $file_path = null;

    // Manipulação de arquivos
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['file'];

        // Ordena os IDs do usuário e do contato para que o menor sempre venha primeiro
        $ids = array($id_user, $id_contato);
        sort($ids);
        
        $upload_dir = "../../../COPIZAP/IMAGEM/UPLOADS/{$ids[0]}-{$ids[1]}/";
        
        // Cria o diretório se ele não existir
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Gerar um nome único para o arquivo para evitar conflitos
        $file_name = uniqid() . '-' . basename($file['name']);
        $file_path = $upload_dir . $file_name;

        // Mover o arquivo para o diretório de upload
        if (move_uploaded_file($file['tmp_name'], $file_path)) {
            // A função 'move_uploaded_file' retorna verdadeiro, então o arquivo foi salvo com sucesso
            echo "Arquivo movido para: $file_path\n";
        } else {
            // Falha ao mover o arquivo
            echo "Falha ao mover o arquivo para: $upload_dir\n";
            $file_path = null;
        }
    } elseif (isset($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE) {
        // Captura o erro se houver, exceto se nenhum arquivo foi enviado
        echo "Erro no upload do arquivo: " . $_FILES['file']['error'];
        $file_path = null;
    }

    // Apenas insere a mensagem se a mensagem ou o arquivo existirem
    if ($mensagem || $file_path) {
        $query_insert_message = "INSERT INTO mensagens_zap (id_user_envio, id_user_recebe, mensagem, arquivo, data_hora, mensagem_lida) VALUES (?, ?, ?, ?, ?, 0)";
        $stmt_insert_message = $conn->prepare($query_insert_message);
        $stmt_insert_message->bind_param("iisss", $id_user, $id_contato, $mensagem, $file_path, $data_hora);

        if ($stmt_insert_message->execute()) {
            // Verificar se o contato já está na lista de contatos do destinatário
            $query_check_contact = "SELECT * FROM contatos WHERE id_user_dono = ? AND id_user_contato = ?";
            $stmt_check_contact = $conn->prepare($query_check_contact);
            $stmt_check_contact->bind_param("ii", $id_contato, $id_user); // Verificar na lista do destinatário
            $stmt_check_contact->execute();
            $result_check_contact = $stmt_check_contact->get_result();

            // Se o contato não estiver na lista, insere na tabela de contatos do destinatário
            if ($result_check_contact->num_rows == 0) {
                $query_insert_contact = "INSERT INTO contatos (id_user_dono, id_user_contato) VALUES (?, ?)";
                $stmt_insert_contact = $conn->prepare($query_insert_contact);
                $stmt_insert_contact->bind_param("ii", $id_contato, $id_user);
                $stmt_insert_contact->execute();
            }

            $response = [
                'status' => 'success',
                'mensagem' => 'Mensagem enviada com sucesso'
            ];
        } else {
            $response = [
                'status' => 'error',
                'mensagem' => 'Erro ao enviar mensagem: ' . $stmt_insert_message->error
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'mensagem' => 'Erro: Mensagem e/ou arquivo não fornecido(s) ou erro no upload.'
        ];
    }

    echo json_encode($response);
?>
