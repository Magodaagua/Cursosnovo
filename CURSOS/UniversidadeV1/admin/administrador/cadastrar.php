<?php
    session_start();
    include_once "../conexao.php";

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (empty($dados['email'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo email!</div>"];
    }elseif (empty($dados['senha'])) {
            $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo senha!</div>"];

    }else{
        $query_admin = "INSERT INTO administrador (email, senha) VALUES (:email, :senha)";
        
        $cad_admin = $conn->prepare($query_admin);
        $cad_admin ->bindParam(':email', $dados['email']);
        $cad_admin ->bindParam(':senha', $dados['senha']);

        $cad_admin ->execute();

        if($cad_admin->rowCount()){
            $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Conta administradora cadastrada com sucesso!</div>"];
        } else {
            $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Conta administradora não cadastrada com sucesso!</div>"];
        }
    }
    echo json_encode($retorna);

?>