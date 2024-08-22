<?php
    include_once "../conexao.php";

    $pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

    if(!empty($pagina)){
        //Calcular o inicio visualização
        $qnt_result_pg = 10;
        $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

        $query_parceiros = "SELECT ID_parceiro, Nome, Descricao, link, imagem FROM parceiro ORDER BY ID_parceiro DESC LIMIT $inicio, $qnt_result_pg ";
        $result_parceiros = $conn->prepare($query_parceiros);
        $result_parceiros->execute();

        $dados = "<div class='table-responsive'>
                    <table class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>ID do parceiro</th>
                                <th>Nome</th>
                                <th>Descricao</th>
                                <th>Link</th>
                                <th>Imagem</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>";

        while($row_parceiros = $result_parceiros->fetch(PDO::FETCH_ASSOC)){
            extract($row_parceiros);
            if ((!empty($imagem))) {
                $img = "<img src='../externo/$ID_parceiro/$imagem' width='150'> <br>";
                $img2 = "<center><button class='btn btn-outline-primary btn-sm'><a href='../externo/$ID_parceiro/$imagem' download>Download</a></button></center><br>";
            } else {
                $img = "";
                $img2 = "";
            }
            $dados .= "<tr>
                            <td>$ID_parceiro</td>
                            <td>$Nome</td>
                            <td>$Descricao</td>
                            <td>$link</td>
                            <td>
                                $img <br> $img2
                            </td>
                            <td>
                                <center>
                                    <button id='$ID_parceiro' class='btn btn-outline-primary btn-sm' onclick='visParceiro($ID_parceiro)'>Visualizar</button><br><br>
                                    <button id='$ID_parceiro' class='btn btn-outline-warning btn-sm' onclick='editParceiroDados($ID_parceiro)'>Editar</button><br><br>
                                    <button id='$ID_parceiro' class='btn btn-outline-danger btn-sm' onclick='apagarParceiroDados($ID_parceiro)'>Apagar</button><br><br>
                                </center>
                            </td>
                        </tr>";
        }

        $dados .= "         </tbody>
                        </table>
                    </div>";

        //Paginação - Somar a quantidade de usuários
        $query_pg = "SELECT COUNT(ID_parceiro) AS num_result FROM parceiro";
        $result_pg = $conn->prepare($query_pg);
        $result_pg->execute();
        $row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

        //Quantidade de pagina
        $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

        $max_links = 2;

        $dados .="<nav aria-label='Page navigation example'> <ul class='pagination pagination-sm justify-content-center'>";
        $dados .="<li class='page-item'><a class='page-link'onClick='listarParceiros(1)' href='#'>Previous</a></li>";
        
        for($pag_ant = $pagina -$max_links; $pag_ant <= $pagina - 1; $pag_ant++){
            if($pag_ant >= 1){
                $dados .= "<li class='page-item'><a class='page-link' onclick='listarParceiros($pag_ant)' href='#'>$pag_ant</a></li>";
            }
        }

        $dados .="<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";

        for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
            if($pag_dep <= $quantidade_pg){
                $dados .="<li class='page-item'><a class='page-link' href='#' onclick='listarParceiros($pag_dep)'>$pag_dep</a></li>";
            }
        }
        
        
        $dados .="<li class='page-item'><a class='page-link' href='#' onClick='listarParceiros($quantidade_pg)'>Última</a></li>";
        $dados .='</ul></nav>'; 

        echo $dados;
    } else {
        echo "<div class='alert alert-danger' role='alert'>Nenhuma empresa parceira encontrada!</div>";
    }

?>