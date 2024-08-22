<?php
    session_start();
    include_once "../conexao.php";

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $arquivo = $_FILES['imagem'];

    if (empty($dados['Nome_cat'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>"];
    } elseif (empty($dados['tipo'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo imagem!</div>"];
    }else{
        $query_categoria = "INSERT INTO categoria (Nome_cat, imagem, tipo) VALUES (:Nome_cat, :imagem, :tipo)";
        $arquivo = $_FILES['imagem'];
        
        $cad_categoria = $conn->prepare($query_categoria);
        $cad_categoria ->bindParam(':Nome_cat', $dados['Nome_cat']);
        $cad_categoria ->bindParam(':tipo', $dados['tipo']);
        $cad_categoria ->bindParam(':imagem', $arquivo['name'], PDO::PARAM_STR);
        $cad_categoria ->execute();

        if($cad_categoria->rowCount()){
            if((isset($arquivo['name'])) and (!empty($arquivo['name']))){
                $ultimo_id = $conn->lastInsertId();

                $diretorio = "../logo/$ultimo_id/";

                mkdir($diretorio, 0755);

                $nome_arquivo = $arquivo['name'];

                move_uploaded_file($arquivo['tmp_name'], $diretorio . $arquivo['name']);

                $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Imagem cadastrada com sucesso</div>"];
            }else{
                $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Curso cadastrado com sucesso!</div>"];
            }
            $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Curso cadastrado com sucesso!</div>"];
        } else {
            $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Curso não cadastrado com sucesso!</div>"];
        }
    }
    echo json_encode($retorna);

?>