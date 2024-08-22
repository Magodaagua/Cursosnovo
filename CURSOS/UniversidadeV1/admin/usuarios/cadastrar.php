<?php
    include_once "../conexao.php";

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (empty($dados['Nome'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>"];
    } elseif (empty($dados['CPF'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo CPF!</div>"];
    } elseif (empty($dados['RG'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo RG!</div>"];
    } elseif (empty($dados['Cargo'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Cargo!</div>"];
    } elseif (empty($dados['email'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo E-mail!</div>"];
    } elseif (empty($dados['senha'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Senha!</div>"];
    /*} elseif (empty($dados['imagem'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo imagem!</div>"];
    */}else{
        $query_usuario = "INSERT INTO usuario (Nome, CPF, RG, Cargo, email, senha) VALUES (:Nome, :CPF, :RG, :Cargo, :email, :senha)";
        $cad_usuario = $conn->prepare($query_usuario);
        $cad_usuario ->bindParam(':Nome', $dados['Nome']);
        $cad_usuario ->bindParam(':CPF', $dados['CPF']);
        $cad_usuario ->bindParam(':RG', $dados['RG']);
        $cad_usuario ->bindParam(':Cargo', $dados['Cargo']);
        $cad_usuario ->bindParam(':email', $dados['email']);
        $cad_usuario ->bindParam(':senha', $dados['senha']);
        //$cad_parceiro ->bindParam(':imagem', $arquivo['name'], PDO::PARAM_STR);
        $cad_usuario ->execute();

        if($cad_usuario->rowCount()){
            /*if((isset($arquivo['name'])) and (!empty($arquivo['name']))){
                $ultimo_id = $conn->lastInsertId();

                $diretorio = "imagens/$ultimo_id/";

                mkdir($diretorio, 0755);

                $nome_arquivo = $arquivo['name'];

                move_uploaded_file($arquivo['tmp_name'], $diretorio . $arquivo['name']);

                $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Imagem cadastrada com sucesso</div>"];
            }else{
                $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Empresa parceira cadastrada com sucesso!</div>"];
            }*/
            $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Usuário cadastrado com sucesso!</div>"];
        } else {
            $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não cadastrado com sucesso!</div>"];
        }
    }
    echo json_encode($retorna);

?>