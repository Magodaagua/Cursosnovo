<?php
include_once "../conexao.php";

$ID_parceiro = filter_input(INPUT_GET, "ID_parceiro", FILTER_SANITIZE_NUMBER_INT);

$result_usuario = "SELECT ID_parceiro, imagem FROM parceiro WHERE ID_parceiro = '$ID_parceiro'";
$resultado_usuario = mysqli_query($con, $result_usuario);
$row_edit =  mysqli_fetch_assoc($resultado_usuario);
$int1 = $row_edit['imagem'];

if (!empty($ID_parceiro)) {

    $query_parceiro = "DELETE FROM parceiro WHERE ID_parceiro=:ID_parceiro";
    $result_parceiro = $conn->prepare($query_parceiro);
    $result_parceiro->bindParam(':ID_parceiro', $ID_parceiro);

    if($result_parceiro->execute()){

           // Verificar se existe o nome da imagem salva no banco de dados
        if(!empty($int1)){
            $diretorio = "../externo/$ID_parceiro";
            $caminho = "../externo/$ID_parceiro/". $int1;

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

        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Empresa Parceira apagada com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Empresa não apagada com sucesso!</div>"];
    }

} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhuma empresa encontrada!</div>"];
}

echo json_encode($retorna);