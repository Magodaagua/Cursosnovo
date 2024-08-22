<?php
    include_once "../conexao.php";

    $pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

    if(!empty($pagina)){
        //Calcular o inicio visualização
        $qnt_result_pg = 10;
        $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

        $query_menu = "SELECT ID_menu, texto1, texto2, texto3, titulo1, titulo2, titulo3, imagem1, imagem2, imagem3, carrosel1, carrosel2, carrosel3 FROM menu ORDER BY ID_menu DESC LIMIT $inicio, $qnt_result_pg ";
        $result_menu = $conn->prepare($query_menu);
        $result_menu->execute();

        $dados = "<div class='table-responsive'>
                    <table class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>ID_menu</th>
                                <th>Texto 1</th>
                                <th>Texto 2</th>
                                <th>Texto 3</th>
                                <th>Titulo 1</th>
                                <th>Titulo 2</th>
                                <th>Titulo 3</th>
                                <th>Imagem 1</th>
                                <th>Imagem 2</th>
                                <th>Imagem 3</th>
                                <th>carrosel 1</th>
                                <th>carrosel 2</th>
                                <th>carrosel 3</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>";

        while($row_menu = $result_menu->fetch(PDO::FETCH_ASSOC)){
            extract($row_menu);
            //$data = date('d/m/Y', strtotime($Datadecriacao));

            //colocar imagem na tela do admin
            if ((!empty($imagem1))) {
                $img = "<img src='../logo/menu/$imagem1' width='150'> <br>";
                $img2 = "<center><button class='btn btn-outline-primary btn-sm'><a href='../logo/menu/$imagem1' download>Download</a></button></center><br>";
                //$img7 = "<center><button class='btn btn-outline-warning btn-sm'><a href='editar.php?ID_menu=ID_menu'>Editar</a></button></center><br>";
            } else {
                $img = "";
                $img2 = "";
            }

            //colocar pdf na tela do admin
            if ((!empty($imagem2))) {
                $img3 = "<img src='../logo/menu/$imagem2' width='150'> <br>";
                $img4 = "<center><button class='btn btn-outline-primary btn-sm'><a href='../logo/menu/$imagem2' download>Download</a></button></center><br>";
            } else {
                $img3 = "";
                $img4 = "";
            }

            //colocar video na tela do admin
            if ((!empty($imagem3))) {
                $img5 = "<img src='../logo/menu/$imagem3' width='150'> <br>";
                $img6 = "<center><button class='btn btn-outline-primary btn-sm'><a href='../logo/menu/$imagem3' download>Download</a></button></center><br>";
            } else {
                $img5 = "";
                $img6 = "";
            }

             //colocar imagem na tela do admin
             if ((!empty($carrosel1))) {
                $car1= "<img src='../logo/menu/$carrosel1' width='150'> <br>";
                $car2 = "<center><button class='btn btn-outline-primary btn-sm'><a href='../logo/menu/$carrosel1' download>Download</a></button></center><br>";
            } else {
                $car1 = "";
                $car2 = "";
            }

            //colocar pdf na tela do admin
            if ((!empty($carrosel2))) {
                $car3 = "<img src='../logo/menu/$carrosel2' width='150'> <br>";
                $car4 = "<center><button class='btn btn-outline-primary btn-sm'><a href='../logo/menu/$carrosel2' download>Download</a></button></center><br>";
            } else {
                $car3 = "";
                $car4 = "";
            }

            //colocar video na tela do admin
            if ((!empty($carrosel3))) {
                $car5 = "<img src='../logo/menu/$carrosel3' width='150'> <br>";
                $car6 = "<center><button class='btn btn-outline-primary btn-sm'><a href='../logo/menu/$carrosel3' download>Download</a></button></center><br>";
            } else {
                $car5 = "";
                $car6 = "";
            }
            
            $dados .= "<tr>
                            <td>$ID_menu</td>
                            <td>$texto1</td>
                            <td>$texto2</td>
                            <td>$texto3</td>
                            <td>$titulo1</td>
                            <td>$titulo2</td>
                            <td>$titulo3</td>
                            <td>
                                $img <br> $img2
                            </td>
                            <td>
                                $img3 <br> $img4   
                            </td>
                            <td>
                                $img5 <br> $img6
                            </td>
                            <td>
                                $car1 <br> $car2
                            </td>
                            <td>
                                $car3 <br> $car4   
                            </td>
                            <td>
                                $car5 <br> $car6
                            </td>
                            <td>
                                <center>
                                    <button id='$ID_menu' class='btn btn-outline-primary btn-sm' onclick='visMenu($ID_menu)'>Visualizar</button><br><br>
                                    <button id='$ID_menu' class='btn btn-outline-warning btn-sm' onclick='editMenuDados($ID_menu)'>Editar</button><br><br>
                            </td>
                        </tr>";
        }

        $dados .= "         </tbody>
                        </table>
                    </div>";

        //Paginação - Somar a quantidade de usuários
        $query_pg = "SELECT COUNT(ID_menu) AS num_result FROM menu";
        $result_pg = $conn->prepare($query_pg);
        $result_pg->execute();
        $row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

        //Quantidade de pagina
        $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

        $max_links = 2;

        /*$dados .="<nav aria-label='Page navigation example'> <ul class='pagination pagination-sm justify-content-center'>";
        $dados .="<li class='page-item'><a class='page-link'onClick='listarMenu(1)' href='#'>Previous</a></li>";
        
        for($pag_ant = $pagina -$max_links; $pag_ant <= $pagina - 1; $pag_ant++){
            if($pag_ant >= 1){
                $dados .= "<li class='page-item'><a class='page-link' onclick='listarMenu($pag_ant)' href='#'>$pag_ant</a></li>";
            }
        }

        $dados .="<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";

        for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
            if($pag_dep <= $quantidade_pg){
                $dados .="<li class='page-item'><a class='page-link' href='#' onclick='listarMenu($pag_dep)'>$pag_dep</a></li>";
            }
        }
        
        
        $dados .="<li class='page-item'><a class='page-link' href='#' onClick='listarMenu($quantidade_pg)'>Última</a></li>";
        $dados .='</ul></nav>'; 
*/
        echo $dados;
    } else {
        echo "<div class='alert alert-danger' role='alert'>Nenhuma empresa parceira encontrada!</div>";
    }

?>