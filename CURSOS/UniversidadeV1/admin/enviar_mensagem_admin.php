<?php
    include 'conexao.php'; // Inclua o arquivo de conexão

    // Verifique se os dados estão sendo recebidos
    if (isset($_POST['usuario'], $_POST['nome'], $_POST['mensagem'], $_POST['tipo'])) {
        // Obtenha o ID do administrador e o nome "Suporte"
        $result_usuario = "SELECT * FROM administrador WHERE email = '$email' ";
        $resultado_usuario = mysqli_query($con, $result_usuario);

        while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
            $id_user = $row_usuario['ID_admin'];
            $nome2 = 'Suporte';
        }

        $usuario = $_POST['usuario'];
        $nome = $_POST['nome'];
        $mensagem = $_POST['mensagem'];
        $tipo = 'suporte';

        // Use declarações preparadas para evitar injeção de SQL
        $stmt = $con->prepare("INSERT INTO mensagens (usuario, nome_usuario, mensagem, tipo, id_admin) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssi', $usuario, $nome2, $mensagem, $tipo, $id_user);

        if ($stmt->execute()) {
            echo "Mensagem enviada com sucesso!";
        } else {
            echo "Erro ao enviar mensagem: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Dados incompletos.";
    }
?>
