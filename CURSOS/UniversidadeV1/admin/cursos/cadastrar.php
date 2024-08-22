<?php
    session_start();
    include_once "../conexao.php";

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $arquivo = $_FILES['imagem'];
    $arquivo2 = $_FILES['pdf'];
    $arquivo3 = $_FILES['video'];

    if (empty($dados['Nome'])) {
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
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo imagem!</div>"];
    */}else{
        $query_curso = "INSERT INTO curso (Nome, Categoria, Subcategoria, Descricao, Datadecriacao, imagem, pdf, video) VALUES (:Nome, :Categoria, :Subcategoria, :Descricao, :Datadecriacao, :imagem, :pdf, :video)";
        $arquivo = $_FILES['imagem'];

        $cad_curso = $conn->prepare($query_curso);
        $cad_curso ->bindParam(':Nome', $dados['Nome']);
        $cad_curso ->bindParam(':Categoria', $dados['Categoria']);
        $cad_curso ->bindParam(':Subcategoria', $dados['Subcategoria']);
        $cad_curso ->bindParam(':Descricao', $dados['Descricao']);
        $cad_curso ->bindParam(':Datadecriacao', $dados['Datadecriacao']);
        $cad_curso ->bindParam(':imagem', $arquivo['name'], PDO::PARAM_STR);
        $cad_curso ->bindParam(':pdf', $arquivo2['name'], PDO::PARAM_STR);
        $cad_curso ->bindParam(':video', $arquivo3['name'], PDO::PARAM_STR);
        //$cad_curso ->bindParam(':prova', $dados['prova']);
        $cad_curso ->execute();

        if($cad_curso->rowCount()){
            //salva imagem na pasta
            if((isset($arquivo['name'])) and (!empty($arquivo['name']))){
                $ultimo_id = $conn->lastInsertId();

                $diretorio = "../imagem/$ultimo_id/";

                mkdir($diretorio, 0755);

                $nome_arquivo = $arquivo['name'];

                move_uploaded_file($arquivo['tmp_name'], $diretorio . $nome_arquivo);

                $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Imagem cadastrada com sucesso</div>"];
            }else{
                $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Empresa parceira cadastrada com sucesso!</div>"];
            }

            //Salva PDF na pasta
            if((isset($arquivo2['name'])) and (!empty($arquivo2['name']))){
                $ultimo_id = $conn->lastInsertId();

                $diretorio = "../pdf/$ultimo_id/";

                mkdir($diretorio, 0755);

                $nome_arquivo = $arquivo2['name'];

                move_uploaded_file($arquivo2['tmp_name'], $diretorio . $nome_arquivo);

                $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>PDF cadastrado com sucesso</div>"];
            }else{
                $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>PDF não cadastrado com sucesso!</div>"];
            }

            //Salva video na pasta
            if((isset($arquivo3['name'])) and (!empty($arquivo3['name']))){
                $ultimo_id = $conn->lastInsertId();

                $diretorio = "../video/$ultimo_id/";

                mkdir($diretorio, 0755);

                $nome_arquivo = $arquivo3['name'];

                move_uploaded_file($arquivo3['tmp_name'], $diretorio . $nome_arquivo);

                $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Video cadastrado com sucesso</div>"];
            }else{
                $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Video não cadastrado com sucesso!</div>"];
            }

            $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Curso cadastrado com sucesso!</div>"];
        } else {
            $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Curso não cadastrado com sucesso!</div>"];
        }
    }
    echo json_encode($retorna);

?>