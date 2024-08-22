<?php
include_once "../conexao.php";

$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);
$categoria = filter_input(INPUT_GET, "categoria", FILTER_SANITIZE_STRING);

if (!empty($pagina)) {
    // Calcular o início da visualização
    $qnt_result_pg = 10;
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

    // Modifique a consulta SQL para filtrar os usuários por categoria
    $query_usuarios = "SELECT ID_usuario, Nome, CPF, RG, Cargo, email, senha FROM usuario";
    
    // Verifique se uma categoria foi selecionada
    if (!empty($categoria)) {
        $query_usuarios .= " WHERE Cargo = :categoria";
    }
    
    $query_usuarios .= " ORDER BY ID_usuario DESC LIMIT $inicio, $qnt_result_pg";

    $result_usuarios = $conn->prepare($query_usuarios);
    
    // Se uma categoria foi selecionada, vincule-a à consulta
    if (!empty($categoria)) {
        $result_usuarios->bindParam(':categoria', $categoria);
    }
    
    $result_usuarios->execute();

    $dados = "<div class='table-responsive'>
                <table class='table table-striped table-bordered'>
                    <thead>
                        <tr>
                            <th>ID do usuário</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>RG</th>
                            <th>Cargo</th>
                            <th>E-mail</th>
                            <th>Senha</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>";

    while ($row_usuarios = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
        extract($row_usuarios);
        $dados .= "<tr>
                        <td>$ID_usuario</td>
                        <td>$Nome</td>
                        <td>$CPF</td>
                        <td>$RG</td>
                        <td>$Cargo</td>
                        <td>$email</td>
                        <td>$senha</td>
                        <td>
                            <center>
                                <button id='$ID_usuario' class='btn btn-outline-primary btn-sm' onclick='visUsuario($ID_usuario)'>Visualizar</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                <button id='$ID_usuario' class='btn btn-outline-warning btn-sm' onclick='editUsuarioDados($ID_usuario)'>Editar</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                <button id='$ID_usuario' class='btn btn-outline-danger btn-sm' onclick='apagarUsuarioDados($ID_usuario)'>Apagar</button>&nbsp;&nbsp;&nbsp;&nbsp;
                            </center>
                        </td>
                    </tr>";
    }

    $dados .= "         </tbody>
                    </table>
                </div>";

    // Paginação - Somar a quantidade de usuários
    $query_pg = "SELECT COUNT(ID_usuario) AS num_result FROM usuario";
    $result_pg = $conn->prepare($query_pg);
    $result_pg->execute();
    $row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

    // Quantidade de páginas
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

    $max_links = 2;

    $dados .= "<nav aria-label='Page navigation example'><ul class='pagination pagination-sm justify-content-center'>";
    $dados .= "<li class='page-item'><a class='page-link' onClick='listarUsuariosPorCategoria(\"$categoria\", 1)' href='#'>Previous</a></li>";

    for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
        if ($pag_ant >= 1) {
            $dados .= "<li class='page-item'><a class='page-link' onclick='listarUsuariosPorCategoria(\"$categoria\", $pag_ant)' href='#'>$pag_ant</a></li>";
        }
    }

    $dados .= "<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";

    for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
        if ($pag_dep <= $quantidade_pg) {
            $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarUsuariosPorCategoria(\"$categoria\", $pag_dep)'>$pag_dep</a></li>";
        }
    }

    $dados .= "<li class='page-item'><a class='page-link' href='#' onClick='listarUsuariosPorCategoria(\"$categoria\", $quantidade_pg)'>Última</a></li>";
    $dados .= '</ul></nav>';

    echo $dados;
} else {
    echo "<div class='alert alert-danger' role='alert'>Nenhum usuário encontrado!</div>";
}
?>
