<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // conexão com banco de dados
    include_once("conexao.php");

    // se receber uma requisição pelo método post cria uma nova sala
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar se todos os campos obrigatórios foram preenchidos
        if (isset($_POST['nomeSala'], $_POST['categoriaSala'], $_POST['descricaoSala'], $_POST['privacidade'], $_POST['idusuario'])) {
            // Recuperando dados do formulário
            $nomeSala = mysqli_real_escape_string($conn, $_POST['nomeSala']);
            $categoriaSala = mysqli_real_escape_string($conn, $_POST['categoriaSala']);
            $categoria1 = mysqli_real_escape_string($conn, $_POST['categoria']);
            $descricaoSala = mysqli_real_escape_string($conn, $_POST['descricaoSala']);
            $privacidade = mysqli_real_escape_string($conn, $_POST['privacidade']);
            $idUsuario = mysqli_real_escape_string($conn, $_POST['idusuario']);

            // Inserindo dados na tabela salas
            $query = "INSERT INTO salas (id_admin_grupo, Nome_grupo, descricao, Categoria, Subcategoria) VALUES ('$idUsuario', '$nomeSala', '$descricaoSala', '$categoriaSala', '$privacidade')";

            // Verificar se a inserção foi bem-sucedida
            if (mysqli_query($conn, $query)) {
                // Obtém o ID da sala que acabou de ser criada
                $idSala = mysqli_insert_id($conn);

                // Insere uma nova linha na tabela inscricao_grupo
                $query_inscricao = "INSERT INTO inscricao_grupo (id_cliente, id_grupo) VALUES ('$idUsuario', '$idSala')";
                if (!mysqli_query($conn, $query_inscricao)) {
                    echo "Erro ao inscrever o usuário na sala: " . mysqli_error($conn);
                }
                // Redirecionar para a página comunidade.php após criar a sala
                header("Location: ../comunidade.php?Dep=".$categoria1);
                exit();
            } else {
                echo "Erro ao criar a sala: " . mysqli_error($conn);
            }
        } else {
            // Se algum campo estiver faltando, exibir uma mensagem de erro
            echo "Todos os campos devem ser preenchidos.";
        }
    }

    mysqli_close($conn);
?>
