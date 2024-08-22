<?php
include_once "../conexao.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$result_usuario = "SELECT id, imagem FROM categoria WHERE id = '$id'";
$resultado_usuario = mysqli_query($con, $result_usuario);
$row_edit =  mysqli_fetch_assoc($resultado_usuario);
$int1 = $row_edit['imagem'];

if (!empty($id)) {

    $query_categoria = "DELETE FROM categoria WHERE id=:id";
    $result_categoria = $conn->prepare($query_categoria);
    $result_categoria->bindParam(':id', $id);

    if($result_categoria->execute()){

        // Verificar se existe o nome da imagem salva no banco de dados
        if(!empty($int1)){
            $diretorio = "../logo/$id";
            $caminho = "../logo/$id/". $int1;

            if(((!empty($int1)) or ($int1 != null))){
                // Apagar a imagem
                if(file_exists($caminho)){
                    unlink($caminho);
                }

                // Apagar o diretorio
                if(file_exists($diretorio)){
                    rmdir($diretorio);
                }
            }
        }

        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Curso apagado com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Curso não apagado com sucesso!</div>"];
    }

} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhuma curso encontrado!</div>"];
}

echo json_encode($retorna);