<?php
include_once "../conexao.php";

$ID_curso = filter_input(INPUT_GET, "ID_curso", FILTER_SANITIZE_NUMBER_INT);

$result_usuario = "SELECT ID_curso, imagem, pdf, video FROM curso WHERE ID_curso = '$ID_curso'";
$resultado_usuario = mysqli_query($con, $result_usuario);
$row_edit =  mysqli_fetch_assoc($resultado_usuario);
$int1 = $row_edit['imagem'];
$int2 = $row_edit['pdf'];
$int3 = $row_edit['video'];

if (!empty($ID_curso)) {

    $query_curso = "DELETE FROM curso WHERE ID_curso=:ID_curso";
    $result_curso = $conn->prepare($query_curso);
    $result_curso->bindParam(':ID_curso', $ID_curso);

    if($result_curso->execute()){

        // Verificar se existe o nome da imagem salva no banco de dados
        if(!empty($int1)){
            $diretorio = "../imagem/$ID_curso";
            $caminho = "../imagem/$ID_curso/". $int1;

            $diretorio2 = "../pdf/$ID_curso";
            $caminho2 = "../pdf/$ID_curso/". $int2;

            $diretorio3 = "../video/$ID_curso";
            $caminho3 = "../video/$ID_curso/". $int3;

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

            if(((!empty($int2)) or ($int2 != null))){
                // Apagar a imagem
                if(file_exists($caminho2)){
                    unlink($caminho2);
                }

                // Apagar o diretorio
                if(file_exists($diretorio2)){
                    rmdir($diretorio2);
                }
            }

            if(((!empty($int3)) or ($int3 != null))){
                // Apagar a imagem
                if(file_exists($caminho3)){
                    unlink($caminho3);
                }

                // Apagar o diretorio
                if(file_exists($diretorio3)){
                    rmdir($diretorio3);
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