<?php
    include_once "../conexao.php";

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $arquivo = $_FILES['imagem'];
    
    $id = $dados['ID_parceiro'];

    $result_usuario = "SELECT ID_parceiro, imagem FROM parceiro WHERE ID_parceiro = '$id'";
    $resultado_usuario = mysqli_query($con, $result_usuario);
    $row_edit =  mysqli_fetch_assoc($resultado_usuario);
    $int1 = $row_edit['imagem'];

    if (empty($dados['ID_parceiro'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Erro tente mais tarde!</div>"];
    } elseif (empty($dados['Nome'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>"];
    } elseif (empty($dados['Descricao'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo descrição!</div>"];
    } elseif (empty($dados['link'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Link!</div>"];
    /*} elseif (empty($dados['imagem'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Imagem!</div>"];
    */}else{
        $query_parceiro= "UPDATE parceiro SET ID_parceiro=:ID_parceiro, Nome=:Nome, Descricao=:Descricao, link=:link, imagem=:imagem WHERE ID_parceiro=:ID_parceiro";
        $imagem = $row_edit['imagem'];

        if($arquivo['name'] == ''){
           $arquivo['name'] = "$imagem";

           $edit_parceiro = $conn->prepare($query_parceiro);
           $edit_parceiro ->bindParam(':ID_parceiro', $dados['ID_parceiro']);
           $edit_parceiro ->bindParam(':Nome', $dados['Nome']);
           $edit_parceiro ->bindParam(':Descricao', $dados['Descricao']);
           $edit_parceiro ->bindParam(':link', $dados['link']);
           $edit_parceiro ->bindParam(':imagem', $imagem);
           $edit_parceiro ->execute();
           
        }else{

            $edit_parceiro = $conn->prepare($query_parceiro);
            $edit_parceiro ->bindParam(':ID_parceiro', $dados['ID_parceiro']);
            $edit_parceiro ->bindParam(':Nome', $dados['Nome']);
            $edit_parceiro ->bindParam(':Descricao', $dados['Descricao']);
            $edit_parceiro ->bindParam(':link', $dados['link']);
            $edit_parceiro ->bindParam(':imagem', $arquivo['name'], PDO::PARAM_STR);
            $edit_parceiro ->execute();

        }
    
        if($edit_parceiro ->rowCount()){

            //$id = $dados('ID_parceiro');
            //$id = 'ID_parceiro';
            $id = $dados['ID_parceiro'];
            $diretorio = "../externo/$id/";

            //if((!file_exists($diretorio)) and (!is_dir($diretorio))){
            if((!file_exists($diretorio))){
                mkdir($diretorio, 0755);
            }

            $nome_arquivo = $arquivo['name'];

            if(move_uploaded_file($arquivo['tmp_name'], $diretorio . $nome_arquivo)){

                if(((!empty($int1)) or ($int1 != null)) and ($int1 != $nome_arquivo)){
                    $endereco_imagem = "../externo/$id/". $int1;
                }
                if(file_exists($endereco_imagem)){
                    unlink($endereco_imagem);
                }

                $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Foto editada com sucesso!</div>"];
            } else {
                $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Foto não editada com sucesso!</div>"];
            }
            
            $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Empresa Parceira editada com sucesso!</div>"];
        } else {
            $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Empresa Parceira não editada com sucesso!</div>"];
        }
    }
    echo json_encode($retorna);

?>