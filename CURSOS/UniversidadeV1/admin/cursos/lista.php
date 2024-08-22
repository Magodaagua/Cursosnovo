<?php
include_once "../conexao.php";

$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);
$categoria = filter_input(INPUT_GET, "categoria", FILTER_SANITIZE_STRING);
echo $categoria;

if (!empty($pagina)) {
    // Calcular o início da visualização
    $qnt_result_pg = 10;
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

    $query_curso = "SELECT ID_curso, Nome, Categoria, Subcategoria, Descricao, Datadecriacao, imagem, pdf, video FROM curso";

    if (!empty($categoria)) {
        // Se uma categoria for especificada, filtre os resultados por essa categoria
        $query_curso .= " WHERE Categoria = :categoria";
    }

    $query_curso .= " ORDER BY ID_curso DESC LIMIT $inicio, $qnt_result_pg";

    $result_curso = $conn->prepare($query_curso);

    if (!empty($categoria)) {
        // Se uma categoria for especificada, faça o bind do parâmetro da categoria
        $result_curso->bindParam(':categoria', $categoria, PDO::PARAM_STR);
    }

    $result_curso->execute();

    $dados = "<div class='table-responsive'>
                <table class='table table-striped table-bordered'>
                    <thead>
                        <tr>
                            <th>ID do Curso</th>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Subcategoria</th>
                            <th>Descricao</th>
                            <th>Datadecriacao</th>
                            <th>Imagem</th>
                            <th>Video</th>
                            <th>PDF</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>";

    while ($row_curso = $result_curso->fetch(PDO::FETCH_ASSOC)) {
        extract($row_curso);
        $data = date('d/m/Y', strtotime($Datadecriacao));

        // colocar imagem na tela do admin
        if (!empty($imagem)) {
            $img = "<img src='../imagem/$ID_curso/$imagem' width='150'> <br>";
            $img2 = "<center><button class='btn btn-outline-primary btn-sm'><a href='../imagem/$ID_curso/$imagem' download>Download</a></button></center><br>";
        } else {
            $img = "";
            $img2 = "";
        }

        // colocar pdf na tela do admin
        if (!empty($pdf)) {
            $pdf1 = "<img src='../pdf/arquivo.png' width='150'> <br>";
            $pdf2 = "<center><button class='btn btn-outline-primary btn-sm'><a href='../pdf/$ID_curso/$pdf' download>Download</a></button></center><br>";
        } else {
            $pdf1 = "";
            $pdf2 = "";
        }

        // colocar video na tela do admin
        if (!empty($video)) {
            $vid = "<img src='../video/play.png' width='150'> <br>";
            $vid2 = "<center><button class='btn btn-outline-primary btn-sm'><a href='../video/$ID_curso/$video' download>Download</a></button></center><br>";
        } else {
            $vid = "";
            $vid2 = "";
        }

        $dados .= "<tr>
                        <td>$ID_curso</td>
                        <td>$Nome</td>
                        <td>$Categoria</td>
                        <td>$Subcategoria</td>
                        <td>$Descricao</td>
                        <td>$data</td>
                        <td>
                            $img <br> $img2
                        </td>
                        <td>
                            $vid <br> $vid2  
                        </td>
                        <td>
                            $pdf1 <br> $pdf2
                        </td>
                        <td>
                            <center>
                                <button id='$ID_curso' class='btn btn-outline-primary btn-sm' onclick='visInterno($ID_curso)'>Visualizar</button><br><br>
                                <button id='$ID_curso' class='btn btn-outline-warning btn-sm' onclick='editInternoDados($ID_curso)'>Editar</button><br><br>
                                <button id='$ID_curso' class='btn btn-outline-danger btn-sm' onclick='apagarInternoDados($ID_curso)'>Apagar</button><br><br>
                            </center>
                        </td>
                    </tr>";
    }

    $dados .= "         </tbody>
                    </table>
                </div>";

    // Paginação - Somar a quantidade de usuários
    $query_pg = "SELECT COUNT(ID_curso) AS num_result FROM curso";
    $result_pg = $conn->prepare($query_pg);
    $result_pg->execute();
    $row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

    // Quantidade de páginas
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

    $max_links = 2;

    $dados .= "<nav aria-label='Page navigation example'> <ul class='pagination pagination-sm justify-content-center'>";
    $dados .= "<li class='page-item'><a class='page-link' onClick='listarInterno(1)' href='#'>Previous</a></li>";

    for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
        if ($pag_ant >= 1) {
            $dados .= "<li class='page-item'><a class='page-link' onclick='listarInterno($pag_ant)' href='#'>$pag_ant</a></li>";
        }
    }

    $dados .= "<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";

    for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
        if ($pag_dep <= $quantidade_pg) {
            $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarInterno($pag_dep)'>$pag_dep</a></li>";
        }
    }

    $dados .= "<li class='page-item'><a class='page-link' href='#' onClick='listarInterno($quantidade_pg)'>Última</a></li>";
    $dados .= '</ul></nav>';

    echo $dados;
} else {
    echo "<div class='alert alert-danger' role='alert'>Nenhuma empresa parceira encontrada!</div>";
}
?>
