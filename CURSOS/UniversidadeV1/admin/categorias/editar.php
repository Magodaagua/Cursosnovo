<?php
    include_once "../conexao.php";

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $id = $dados['id'];

    $result_usuario = "SELECT id, imagem, tipo FROM categoria WHERE id = '$id'";
    $resultado_usuario = mysqli_query($con, $result_usuario);
    $row_edit =  mysqli_fetch_assoc($resultado_usuario);
    $int1 = $row_edit['imagem'];

    $arquivo = $_FILES['imagem'];
    //$id = $_GET['editId'];

    if (empty($dados['id'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Erro tente mais tarde!</div>"];
    } elseif (empty($dados['Nome_cat'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>"];
    } elseif (empty($dados['tipo'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Imagem!</div>"];
    }else{
        $query_categoria= "UPDATE categoria SET id=:id, Nome_cat=:Nome_cat, imagem=:imagem, tipo=:tipo WHERE id=:id";
        $imagem = $row_edit['imagem'];

        if($arquivo['name'] == ''){
            $arquivo['name'] = "$imagem";

            $edit_categoria = $conn->prepare($query_categoria);
            $edit_categoria ->bindParam(':id', $dados['id']);
            $edit_categoria ->bindParam(':Nome_cat', $dados['Nome_cat']);
            $edit_categoria ->bindParam(':imagem', $imagem);
            $edit_categoria ->bindParam(':tipo', $dados['tipo']);
            $edit_categoria ->execute();

        }else{
            $edit_categoria = $conn->prepare($query_categoria);
            $edit_categoria ->bindParam(':id', $dados['id']);
            $edit_categoria ->bindParam(':Nome_cat', $dados['Nome_cat']);
            $edit_categoria ->bindParam(':imagem', $arquivo['name'], PDO::PARAM_STR);
            $edit_categoria ->bindParam(':tipo', $dados['tipo']);
            $edit_categoria ->execute();
        }
    
        if($edit_categoria ->rowCount()){

            $id = $dados['id'];

            //$id = 'id';
            //$Nome_cat = $dados['Nome_cat'];
            $diretorio = "../logo/$id/";

            //if((!file_exists($diretorio)) and (!is_dir($diretorio))){
            if((!file_exists($diretorio))){
                mkdir($diretorio, 0755);
            }

            $nome_arquivo = $arquivo['name'];

            if(move_uploaded_file($arquivo['tmp_name'], $diretorio . $nome_arquivo)){
                
                if(((!empty($int1)) or ($int1 != null)) and ($int1 != $nome_arquivo)){
                    $endereco_imagem = "../logo/$id/". $int1;
                }
                if(file_exists($endereco_imagem)){
                    unlink($endereco_imagem);
                }


                $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Foto editada com sucesso!</div>"];
            } else {
                $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Foto não editada com sucesso!</div>"];
            }
            
            $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Curso editado com sucesso!</div>"];
        } else {
            $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Curso não editado com sucesso!</div>"];
        }
    }
    echo json_encode($retorna);

?>