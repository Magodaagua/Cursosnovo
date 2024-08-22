<?php
    include_once "../conexao.php";

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (empty($dados['ID_admin'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Erro tente mais tarde!</div>"];
    } elseif (empty($dados['email'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo email!</div>"];
    } elseif (empty($dados['senha'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo senha!</div>"];
    }else{
        $query_admin= "UPDATE administrador SET ID_admin=:ID_admin, email=:email, senha=:senha WHERE ID_admin=:ID_admin";
        
        $edit_admin = $conn->prepare($query_admin);
        $edit_admin ->bindParam(':ID_admin', $dados['ID_admin']);
        $edit_admin ->bindParam(':email', $dados['email']);
        $edit_admin ->bindParam(':senha', $dados['senha']);
        $edit_admin ->execute();
    
        if($edit_admin ->rowCount()){
            $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Conta administradora editada com sucesso!</div>"];
        } else {
            $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Conta administradora não editada com sucesso!</div>"];
        }
    }
    echo json_encode($retorna);

?>