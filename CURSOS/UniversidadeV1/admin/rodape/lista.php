<?php
    include_once "../conexao.php";

    $pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

    if(!empty($pagina)){
        //Calcular o inicio visualização
        $qnt_result_pg = 10;
        $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

        $query_rodape = "SELECT ID_rodape, politica, termos FROM rodape ORDER BY ID_rodape DESC LIMIT $inicio, $qnt_result_pg ";
        $result_rodape = $conn->prepare($query_rodape);
        $result_rodape->execute();


        while($row_rodape = $result_rodape->fetch(PDO::FETCH_ASSOC)){
            extract($row_rodape);

        $dados = "<div class='table-responsive'>
                    <table class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>Política</th>
                                <td>$politica</td>
                                
                            </tr>
                            <tr>
                                <th>Termos de uso</th>
                                <td>$termos</td>
                            </tr>
                            <tr>
                                <th>Ações</th>
                                <td>
                                    <center>
                                        <button id='$ID_rodape' class='btn btn-outline-primary btn-sm' onclick='visRodape($ID_rodape)'>Visualizar</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button id='$ID_rodape' class='btn btn-outline-warning btn-sm' onclick='editRodapeDados($ID_rodape)'>Editar</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                    </center>
                                </td>
                            </tr>
                        </thead>
                        <tbody>";
        }
        $dados .= "         </tbody>
                        </table>
                    </div>";

        //Paginação - Somar a quantidade de usuários
        $query_pg = "SELECT COUNT(ID_rodape) AS num_result FROM rodape";
        $result_pg = $conn->prepare($query_pg);
        $result_pg->execute();
        $row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

        //Quantidade de pagina
        $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

        $max_links = 2;

        /*$dados .="<nav aria-label='Page navigation example'> <ul class='pagination pagination-sm justify-content-center'>";
        $dados .="<li class='page-item'><a class='page-link'onClick='listarRodape(1)' href='#'>Previous</a></li>";
        
        for($pag_ant = $pagina -$max_links; $pag_ant <= $pagina - 1; $pag_ant++){
            if($pag_ant >= 1){
                $dados .= "<li class='page-item'><a class='page-link' onclick='listarRodape($pag_ant)' href='#'>$pag_ant</a></li>";
            }
        }

        $dados .="<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";

        for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
            if($pag_dep <= $quantidade_pg){
                $dados .="<li class='page-item'><a class='page-link' href='#' onclick='listarRodape($pag_dep)'>$pag_dep</a></li>";
            }
        }
        
        
        $dados .="<li class='page-item'><a class='page-link' href='#' onClick='listarRodape($quantidade_pg)'>Última</a></li>";
        $dados .='</ul></nav>'; */

        echo $dados;
    } else {
        echo "<div class='alert alert-danger' role='alert'>Nenhuma empresa parceira encontrada!</div>";
    }

?>