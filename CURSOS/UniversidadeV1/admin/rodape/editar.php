<?php
    include_once "../conexao.php";

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
   
    if (empty($dados['ID_rodape'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Erro tente mais tarde!</div>"];
    } elseif (empty($dados['politica'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo política!</div>"];
    } elseif (empty($dados['termos'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo termos!</div>"];
    }else{
        $query_rodape = "UPDATE rodape SET ID_rodape=:ID_rodape, politica=:politica, termos=:termos WHERE ID_rodape=:ID_rodape";

        $edit_rodape = $conn->prepare($query_rodape);
        $edit_rodape ->bindParam(':ID_rodape', $dados['ID_rodape']);
        $edit_rodape ->bindParam(':politica', $dados['politica']);
        $edit_rodape ->bindParam(':termos', $dados['termos']);
        $edit_rodape ->execute();

        if($edit_rodape->rowCount()){
            $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Rodapé editado com sucesso!</div>"];
        } else {
            $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Rodapé não editado com sucesso!</div>"];
        }
    }
    echo json_encode($retorna);

?>