<?php
    // conexão com o banco de dados
    include 'conexao.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Verifique se id_grupo está presente em $_GET
    if (isset($_GET['id_grupo']) && isset($_GET['id_user'])) {
        $id_grupo = $_GET['id_grupo'];
        $id_user = $_GET['id_user'];

        // Seleciona todas as mensagens escritas no banco de dados
        $sql = "SELECT id, id_usuario, nome_usuario, id_grupo, mensagem, arquivos, data_envio FROM mensagensgrupo WHERE id_grupo = $id_grupo ORDER BY data_envio DESC LIMIT 10";
        $result = $conn->query($sql);

        // se procurar no banco de dados e tiver um retorno
        if ($result->num_rows > 0) {
            $mensagens = array();
            while ($row = $result->fetch_assoc()) {
                $mensagens[] = $row;
            }
            // Inverter a ordem das mensagens
            $mensagens = array_reverse($mensagens);
            foreach ($mensagens as $row) {
                // Adicione classes específicas com base no tipo de usuário
                $messageClass = ($row["id_usuario"] == $id_user) ? "my-message" : "other-message";
                
                // Formatando a data e hora
                $dataFormatada = date('d/m/Y', strtotime($row["data_envio"]));
                $horaFormatada = date('H:i', strtotime($row["data_envio"]));
            
                // Adicione a classe correspondente à div de mensagem e exiba a data e a hora dentro do balão de fala
                echo "<div class='message-balloon $messageClass'><strong>" . $row["nome_usuario"] . ":</strong> " . $row["mensagem"];
                
                // Verifique se há um arquivo anexado
                if (!empty($row["arquivos"])) {
                    $filePath = "uploads/" . $row["id_grupo"] . "/" . $row["arquivos"];
                    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                    
                    // Verifique o tipo de arquivo e exiba conforme apropriado
                    if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                        echo "<br><img src='$filePath' alt='Imagem' style='max-width: 200px;'>";
                    } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                        echo "<br><video width='320' height='240' controls><source src='$filePath' type='video/$fileExtension'>Seu navegador não suporta o vídeo.</video>";
                    } elseif (in_array($fileExtension, ['mp3', 'wav', 'ogg'])) {
                        echo "<br><audio controls><source src='$filePath' type='audio/$fileExtension'>Seu navegador não suporta o elemento de áudio.</audio>";
                    } else {
                        echo "<br><a href='$filePath' target='_blank'>Download do arquivo</a>";
                    }
                }

                echo "<br><span class='data'>$dataFormatada</span><span class='hora'>$horaFormatada</span></div><br>";
            }

            echo "<script>document.getElementById('messages-container').scrollTop = document.getElementById('messages-container').scrollHeight;</script>";
        } else {
            echo "<p>Nenhuma mensagem.</p>";
        }
    } else {
        echo "Não pegou o ID do Grupo ou do Usuário.";
    }
?>
