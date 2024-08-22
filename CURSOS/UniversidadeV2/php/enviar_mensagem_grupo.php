<?php
    // conexão com banco de dados
    include 'conexao.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    function criarPastaGrupo($id_grupo) {
        $path = "../uploads/" . $id_grupo;
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        return $path;
    }

    // Verifique se os dados estão sendo recebidos
    if (isset($_POST['usuario'], $_POST['nome'], $_POST['id_grupo'], $_POST['mensagem'])) {
        $usuario = $_POST['usuario'];
        $nome = $_POST['nome'];
        $id_grupo = $_POST['id_grupo'];
        $mensagem = $_POST['mensagem'];
        $arquivos = "";

        // Verifique se o usuário ainda está no grupo
        $query = "SELECT * FROM inscricao_grupo WHERE id_cliente = $usuario AND id_grupo = $id_grupo";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 0) {
            echo "removido";
            exit;
        }

        // Verifique se um arquivo foi enviado
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $fileSize = $_FILES['file']['size'];
            $fileType = $_FILES['file']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // Caminho do upload
            $uploadPath = criarPastaGrupo($id_grupo) . "/" . $fileName;

            if(move_uploaded_file($fileTmpPath, $uploadPath)) {
                $arquivos = $fileName;
            } else {
                echo "Erro ao mover o arquivo.";
                exit;
            }
        }

        // se o campo mensagem não for vazio
        if($mensagem != '' || $arquivos != '') {
            // insere na tabela mensagensgrupo a mensagem que o usuário escreveu neste grupo
            $stmt = $conn->prepare("INSERT INTO mensagensgrupo (id_usuario, nome_usuario, id_grupo, mensagem, arquivos) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('sssss', $usuario, $nome, $id_grupo, $mensagem, $arquivos);

            //se tudo ocorrer bem mensagem enviada com sucesso
            if ($stmt->execute()) {
                echo "Mensagem enviada com sucesso!";
            } else {
                echo "Erro ao enviar mensagem: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Dados incompletos.";
        }
    } else {
        echo "Dados incompletos.";
    }
?>
