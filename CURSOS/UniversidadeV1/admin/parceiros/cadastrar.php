<?php
    session_start();
    ob_start();
    include_once "../conexao.php";

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $arquivo = $_FILES['imagem'];

    if (empty($dados['Nome'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>"];
    } elseif (empty($dados['Descricao'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo descrição!</div>"];
    } elseif (empty($dados['link'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Link!</div>"];
    /*} elseif (empty($dados['imagem'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo imagem!</div>"];
    */}else{
        $query_parceiro = "INSERT INTO parceiro (Nome, Descricao, link, imagem) VALUES (:Nome, :Descricao, :link, :imagem)";
        $arquivo = $_FILES['imagem'];
        
        $cad_parceiro = $conn->prepare($query_parceiro);
        $cad_parceiro ->bindParam(':Nome', $dados['Nome']);
        $cad_parceiro ->bindParam(':Descricao', $dados['Descricao']);
        $cad_parceiro ->bindParam(':link', $dados['link']);
        $cad_parceiro ->bindParam(':imagem', $arquivo['name'], PDO::PARAM_STR);
        $cad_parceiro ->execute();

        if($cad_parceiro->rowCount()){
            if((isset($arquivo['name'])) and (!empty($arquivo['name']))){
                $ultimo_id = $conn->lastInsertId();

                $diretorio = "../externo/$ultimo_id/";

                mkdir($diretorio, 0755);

                $nome_arquivo = $arquivo['name'];

                move_uploaded_file($arquivo['tmp_name'], $diretorio . $arquivo['name']);

                $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Imagem cadastrada com sucesso</div>"];
            }else{
                $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Empresa parceira cadastrada com sucesso!</div>"];
            }
            $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Empresa parceira cadastrada com sucesso!</div>"];
        } else {
            $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Empresa parceira não cadastrada com sucesso!</div>"];
        }
    }
    echo json_encode($retorna);

?>