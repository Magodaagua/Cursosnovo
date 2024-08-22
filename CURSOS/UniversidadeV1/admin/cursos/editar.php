<?php
    include_once "../conexao.php";

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $id = $dados['ID_curso'];

    $result_usuario = "SELECT ID_curso, imagem, pdf, video FROM curso WHERE ID_curso = '$id'";
    $resultado_usuario = mysqli_query($con, $result_usuario);
    $row_edit =  mysqli_fetch_assoc($resultado_usuario);
    $int1 = $row_edit['imagem'];
    $int2 = $row_edit['pdf'];
    $int3 = $row_edit['video'];

    $arquivo = $_FILES['imagem'];
    $arquivo2 = $_FILES['pdf'];
    $arquivo3 = $_FILES['video'];

    if (empty($dados['ID_curso'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Erro tente mais tarde!</div>"];
    } elseif (empty($dados['Nome'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>"];
    } elseif (empty($dados['Categoria'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo categoria!</div>"];
    } elseif (empty($dados['Subcategoria'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo subcategoria!</div>"];
    } elseif (empty($dados['Descricao'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo descrição!</div>"];
    } elseif (empty($dados['Datadecriacao'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo data de criação!</div>"];
    /*} elseif (empty($dados['imagem'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Imagem!</div>"];
    */}else{
        $query_curso = "UPDATE curso SET ID_curso=:ID_curso, Nome=:Nome, Categoria=:Categoria, Subcategoria=:Subcategoria, Descricao=:Descricao, Datadecriacao=:Datadecriacao, imagem=:imagem, pdf=:pdf, video=:video WHERE ID_curso=:ID_curso";
        $imagem = $row_edit['imagem'];
        $pdf = $row_edit['pdf'];
        $video = $row_edit['video'];

        if($arquivo['name'] == ''){
           $arquivo['name'] = "$imagem";
           $arquivo2['name'] = "$pdf";
           $arquivo3['name'] = "$video";

           $edit_curso = $conn->prepare($query_curso);
           $edit_curso ->bindParam(':ID_curso', $dados['ID_curso']);
           $edit_curso ->bindParam(':Nome', $dados['Nome']);
           $edit_curso ->bindParam(':Categoria', $dados['Categoria']);
           $edit_curso ->bindParam(':Subcategoria', $dados['Subcategoria']);
           $edit_curso ->bindParam(':Descricao', $dados['Descricao']);
           $edit_curso ->bindParam(':Datadecriacao', $dados['Datadecriacao']);
           $edit_curso ->bindParam(':imagem', $imagem);
           $edit_curso ->bindParam(':pdf', $pdf);
           $edit_curso ->bindParam(':video', $video);
           //$edit_curso ->bindParam(':prova', $dados['prova']);
           $edit_curso ->execute();

        }else{

            $edit_curso = $conn->prepare($query_curso);
            $edit_curso ->bindParam(':ID_curso', $dados['ID_curso']);
            $edit_curso ->bindParam(':Nome', $dados['Nome']);
            $edit_curso ->bindParam(':Categoria', $dados['Categoria']);
            $edit_curso ->bindParam(':Subcategoria', $dados['Subcategoria']);
            $edit_curso ->bindParam(':Descricao', $dados['Descricao']);
            $edit_curso ->bindParam(':Datadecriacao', $dados['Datadecriacao']);
            $edit_curso ->bindParam(':imagem', $arquivo['name'], PDO::PARAM_STR);
            $edit_curso ->bindParam(':pdf', $arquivo2['name'], PDO::PARAM_STR);
            $edit_curso ->bindParam(':video', $arquivo3['name'], PDO::PARAM_STR);
            //$edit_curso ->bindParam(':prova', $dados['prova']);
            $edit_curso ->execute();

        }

        if($edit_curso->rowCount()){

            $id = $dados['ID_curso'];
            $diretorio = "../imagem/$id/";
            $diretorio2 = "../pdf/$id/";
            $diretorio3 = "../video/$id/";

            if((!file_exists($diretorio))){
                mkdir($diretorio, 0755);
            }

            if((!file_exists($diretorio2))){
                mkdir($diretorio2, 0755);
            }

            if((!file_exists($diretorio3))){
                mkdir($diretorio3, 0755);
            }

            $nome_arquivo = $arquivo['name'];
            $nome_arquivo2 = $arquivo2['name'];
            $nome_arquivo3 = $arquivo3['name'];

            //atualiza a imagem
            if(move_uploaded_file($arquivo['tmp_name'], $diretorio . $nome_arquivo)){

                if(((!empty($int1)) or ($int1 != null)) and ($int1 != $nome_arquivo)){
                    $endereco_imagem = "../imagem/$id/". $int1;
                }
                if(file_exists($endereco_imagem)){
                    unlink($endereco_imagem);
                }

                $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Foto editada com sucesso!</div>"];
            } else {
                $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Foto não editada com sucesso!</div>"];
            }

            //atualiza o pdf
            if(move_uploaded_file($arquivo2['tmp_name'], $diretorio2 . $nome_arquivo2)){

                if(((!empty($int2)) or ($int2 != null)) and ($int2 != $nome_arquivo2)){
                    $endereco_imagem = "../pdf/$id/". $int2;
                }
                if(file_exists($endereco_imagem)){
                    unlink($endereco_imagem);
                }

                $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>PDF editada com sucesso!</div>"];
            } else {
                $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: PDF não editada com sucesso!</div>"];
            }

            //atualiza o video
            if(move_uploaded_file($arquivo3['tmp_name'], $diretorio3 . $nome_arquivo3)){

                if(((!empty($int3)) or ($int3 != null)) and ($int3 != $nome_arquivo2)){
                    $endereco_imagem = "../video/$id/". $int3;
                }
                if(file_exists($endereco_imagem)){
                    unlink($endereco_imagem);
                }

                $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Video editada com sucesso!</div>"];
            } else {
                $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Video não editada com sucesso!</div>"];
            }


            $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Curso editado com sucesso!</div>"];
        } else {
            $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Curso não editado com sucesso!</div>"];
        }
    }
    echo json_encode($retorna);

?>