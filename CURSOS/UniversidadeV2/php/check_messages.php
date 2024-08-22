<?php
    include_once "conexao.php";

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    date_default_timezone_set('America/Sao_Paulo');

    // Verifica se o ID do usuário está definido na sessão
    if (isset($_POST['id_user'])) {
        $id_user = $_POST['id_user'];

        // Consulta para selecionar mensagens não lidas
        $query = "SELECT * FROM mensagens_zap WHERE id_user_recebe = ? AND mensagem_lida = 0";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica se há mensagens não lidas
        if ($result->num_rows > 0) {
            echo "true";
            $stmt->close();
            $conn->close();
            exit;
        }
        $stmt->close();

        // Consulta para selecionar eventos da última semana
        $query = "SELECT Evento FROM eventos WHERE DataPublicado >= NOW() - INTERVAL 1 WEEK";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica se há eventos da última semana
        if ($result->num_rows > 0) {
            echo "true";
            $stmt->close();
            $conn->close();
            exit;
        }
        $stmt->close();

        // Consulta para selecionar comunicados da última semana
        $query = "SELECT Titulo FROM comunicados WHERE DataPublicado >= NOW() - INTERVAL 1 WEEK";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica se há comunicados da última semana
        if ($result->num_rows > 0) {
            echo "true";
            $stmt->close();
            $conn->close();
            exit;
        }
        $stmt->close();

        // Consulta para selecionar aniversariantes de hoje
        $query = "SELECT Nome FROM usuario WHERE DAY(Aniversario) = DAY(CURDATE()) AND MONTH(Aniversario) = MONTH(CURDATE())";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica se há aniversariantes hoje
        if ($result->num_rows > 0) {
            echo "true";
            $stmt->close();
            $conn->close();
            exit;
        }
        $stmt->close();

        // Consulta para selecionar novos funcionários da última semana
        $query = "SELECT Nome FROM usuario WHERE Admissao >= CURDATE() - INTERVAL 1 WEEK";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica se há novos funcionários da última semana
        if ($result->num_rows > 0) {
            echo "true";
            $stmt->close();
            $conn->close();
            exit;
        }
        $stmt->close();
        
        // Se nenhuma condição acima for atendida, retorna false
        $conn->close();
        echo "false";
    } else {
        // Se o ID do usuário não estiver definido, retorna false
        echo "false";
    }
?>
