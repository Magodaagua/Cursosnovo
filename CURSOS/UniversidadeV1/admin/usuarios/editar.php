<?php
    include_once "../conexao.php";

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (empty($dados['ID_usuario'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Erro tente mais tarde!</div>"];
    } elseif (empty($dados['Nome'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Nome!</div>"];
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
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Imagem!</div>"];
    */}else{
        $query_usuario= "UPDATE usuario SET Nome=:Nome, CPF=:CPF, RG=:RG, Cargo=:Cargo, email=:email, senha=:senha WHERE ID_usuario=:ID_usuario";
        
        $edit_usuario = $conn->prepare($query_usuario);
        $edit_usuario ->bindParam(':ID_usuario', $dados['ID_usuario']);
        $edit_usuario ->bindParam(':Nome', $dados['Nome']);
        $edit_usuario ->bindParam(':CPF', $dados['CPF']);
        $edit_usuario ->bindParam(':RG', $dados['RG']);
        $edit_usuario ->bindParam(':Cargo', $dados['Cargo']);
        $edit_usuario ->bindParam(':email', $dados['email']);
        $edit_usuario ->bindParam(':senha', $dados['senha']);
        //$edit_parceiro ->bindParam(':imagem', $dados['imagem']);
        $edit_usuario ->execute();
    
        if($edit_usuario ->rowCount()){
            $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Usuário editado com sucesso!</div>"];
        } else {
            $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não editado com sucesso!</div>"];
        }
    }
    echo json_encode($retorna);

?>