<?php
session_start(); // Iniciar a sessão (se ainda não estiver iniciada)

// Incluir o arquivo com a conexão com banco de dados
include_once 'conexao.php';

// Verificar se a conexão com o banco de dados está estabelecida
if (!$con) {
    die("Erro ao conectar ao banco de dados.");
}

// Receber o ID da aula, módulo e curso
$aula_id = filter_input(INPUT_GET, 'aula_id', FILTER_SANITIZE_NUMBER_INT);
$modulo_id = filter_input(INPUT_GET, 'modulo_id', FILTER_SANITIZE_NUMBER_INT);
$curso_id = filter_input(INPUT_GET, 'curso_id', FILTER_SANITIZE_NUMBER_INT);
$id_user = filter_input(INPUT_GET, 'ID_usuario', FILTER_SANITIZE_NUMBER_INT);

// Acessar somente se o formulário for submetido via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se o campo 'estrela' está presente e não está vazio
    //echo"entrou no post<br>";
    if (isset($_POST['estrela']) && !empty($_POST['estrela'])) {
        //echo"entrou no na estrala<br>";
        $estrela = filter_input(INPUT_POST, 'estrela', FILTER_VALIDATE_INT);
        $mensagem = isset($_POST['mensagem']) ? trim($_POST['mensagem']) : '';
        //echo $estrela."<br>";
        //echo $mensagem."<br>";
        // Verificar se a quantidade de estrelas é válida
        if ($estrela !== false && $estrela >= 1 && $estrela <= 5) {
            //echo"entrou no if de um a cinco<br>";
            // Criar a QUERY para cadastrar no banco de dados
            $query_avaliacao = "INSERT INTO avaliacoes (qtd_estrela, mensagem, created, aula_id, modulo_id, curso_id, id_user) 
                                VALUES (:qtd_estrela, :mensagem, :created, :aula_id, :modulo_id, :curso_id, :id_user)";

            try {
                //echo"entrou no try <br>";
                // Preparar a QUERY
                $cad_avaliacao = $con->prepare($query_avaliacao);

                // Bind dos parâmetros
                $cad_avaliacao->bindParam(':qtd_estrela', $estrela, PDO::PARAM_INT);
                $cad_avaliacao->bindParam(':mensagem', $mensagem, PDO::PARAM_STR);
                $cad_avaliacao->bindParam(':created', date("Y-m-d H:i:s"));
                $cad_avaliacao->bindParam(':aula_id', $aula_id, PDO::PARAM_INT);
                $cad_avaliacao->bindParam(':modulo_id', $modulo_id, PDO::PARAM_INT);
                $cad_avaliacao->bindParam(':curso_id', $curso_id, PDO::PARAM_INT);
                $cad_avaliacao->bindParam(':id_user', $id_user, PDO::PARAM_INT);

                //echo "Query: " . $query_avaliacao. '<br>';
                // Executar a QUERY
                if ($cad_avaliacao->execute()) {
                    //echo"entrou no executar<br>";
                    $_SESSION['msg'] = "<p style='color: green;'>Avaliação cadastrada com sucesso.</p>";
                } else {
                    //echo"entrou não entrou no executar<br>";
                    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Avaliação não cadastrada.</p>";
                }
            } catch (PDOException $e) {
                //echo"entrou no catch<br>";
                echo "Erro ao executar a query: " . $e->getMessage();
            }
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Quantidade de estrelas inválida.</p>";
        }
    } else {
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Necessário selecionar pelo menos 1 estrela.</p>";
    }
}

// Redirecionar o usuário de volta para a página anterior
header("Location: ../visualizar_aula.php?id=$aula_id&modulo_id=$modulo_id&curso_id=$curso_id");
exit; // Terminar o script após redirecionamento
?>
