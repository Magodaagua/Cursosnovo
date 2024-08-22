const tbody = document.querySelector(".listar-categorias");
const cadForm = document.getElementById("cad-categoria-form");
const editForm = document.getElementById("edit-categoria-form");
const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");
const msgAlertaErroEdit = document.getElementById("msgAlertaErroEdit");
const msgAlerta = document.getElementById("msgAlerta");
const cadModal = new bootstrap.Modal(document.getElementById("cadCategoriaModal"));

const listarCategoria = async (pagina) => {
    const dados = await fetch("./lista.php?pagina=" + pagina);
    const resposta = await dados.text();
    tbody.innerHTML = resposta;
}

listarCategoria(1);

cadForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    
    const dadosForm = new FormData(cadForm);
    dadosForm.append("add", 1);

    document.getElementById("cad-categoria-btn").value = "Salvando...";
    
    const dados = await fetch("cadastrar.php", {
        method: "POST",
        body: dadosForm,
    });

    const resposta = await dados.json();
    
    if(resposta['erro']){
        msgAlertaErroCad.innerHTML = resposta['msg'];
    }else{
        msgAlerta.innerHTML = resposta['msg'];
        cadForm.reset();
        cadModal.hide();
        listarCategoria(1);
    }
    document.getElementById("cad-categoria-btn").value = "Cadastrar";
});


async function visCategoria(id) {
    //console.log("Acessou: " + id);
    const dados = await fetch('visualizar.php?id=' + id);
    const resposta = await dados.json();
    console.log(resposta);

    if (resposta['erro']) {
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const visModal = new bootstrap.Modal(document.getElementById("visCategoriaModal"));
        visModal.show();

        document.getElementById("visID").innerHTML = resposta['dados'].id;
        document.getElementById("visNome").innerHTML = resposta['dados'].Nome_cat;
        document.getElementById("visimagem").innerHTML = resposta['dados'].imagem;
        document.getElementById("vistipo").innerHTML = resposta['dados'].tipo;
    }

}

async function editCategoriaDados(id){
    msgAlertaErroEdit.innerHTML = "";

    const dados = await fetch('visualizar.php?id=' + id);
    const resposta = await dados.json();
    console.log(resposta);

    if(resposta['erro']){
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const editModal = new bootstrap.Modal(document.getElementById("editCategoriaModal"));
        editModal.show();
        document.getElementById("editId").value  = resposta['dados'].id;
        document.getElementById("editNome").value  = resposta['dados'].Nome_cat;
        document.getElementById("editTipo").value  = resposta['dados'].tipo;
        //document.getElementById("editlink").value  = resposta['dados'].link;
        //document.getElementById("editimagem").value  = resposta['dados'].imagem;
    }
}

editForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    document.getElementById("edit-categoria-btn").value = "Salvando...";

    const dadosForm = new FormData(editForm);
    //console.log(dadosForm);
    /*for (var dadosFormEdit of dadosForm.entries()){
        console.log(dadosFormEdit[0] + " - " + dadosFormEdit[1]);
    }*/

    const dados = await fetch("editar.php", {
        method: "POST",
        body:dadosForm
    });

    console.log(dados);
    const resposta = await dados.json();
    console.log(resposta);

    if(resposta['erro']){
        msgAlertaErroEdit.innerHTML = resposta['msg'];
    }else{
        msgAlertaErroEdit.innerHTML = resposta['msg'];
        listarCategoria(1);
    }

    document.getElementById("edit-categoria-btn").value = "Salvar";
});

async function apagarCategoriaDados(id){
    //console.log("Acessou a função: " + ID_parceiro);
    var confirmar = confirm("Tem certeza que deseja excluir o registro selecionado?");

    if(confirmar == true){    
        const dados = await fetch('apagar.php?id= ' + id);

        const resposta = await dados.json();
        if(resposta['erro']){
            msgAlerta.innerHTML = resposta['msg'];
        }else{
            msgAlerta.innerHTML = resposta['msg'];
            listarCategoria(1);
        }
    }
}

// Função para listar cursos por categoria
const listarCursosPorCategoria = async (categoria) => {
    const dados = await fetch("./lista.php?pagina=1&tipo=" + categoria);
    const resposta = await dados.text();
    tbody.innerHTML = resposta;
}

// Evento de envio do formulário de seleção de categoria
const categoriaForm = document.getElementById("categoria-form");
categoriaForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const selectedCategoria = document.getElementById("id_categoria").value;

    // Atualize a lista de cursos com base na categoria selecionada
    listarCursosPorCategoria(selectedCategoria);
});