const tbody = document.querySelector(".listar-curso");
const cadForm = document.getElementById("cad-interno-form");
const editForm = document.getElementById("edit-interno-form");
const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");
const msgAlertaErroEdit = document.getElementById("msgAlertaErroEdit");
const msgAlerta = document.getElementById("msgAlerta");
const cadModal = new bootstrap.Modal(document.getElementById("cadInternoModal"));

const listarInterno = async (pagina) => {
    const dados = await fetch("./lista.php?pagina=" + pagina);
    const resposta = await dados.text();
    tbody.innerHTML = resposta;
}

listarInterno(1);

cadForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    
    const dadosForm = new FormData(cadForm);
    dadosForm.append("add", 1);

    document.getElementById("cad-interno-btn").value = "Salvando...";
    
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
        listarInterno(1);
    }
    document.getElementById("cad-interno-btn").value = "Cadastrar";
});


async function visInterno(ID_curso) {
    //console.log("Acessou: " + id);
    const dados = await fetch('visualizar.php?ID_curso=' + ID_curso);
    const resposta = await dados.json();
    //console.log(resposta);

    if (resposta['erro']) {
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const visModal = new bootstrap.Modal(document.getElementById("visInternoModal"));
        visModal.show();

        document.getElementById("visID_curso").innerHTML = resposta['dados'].ID_curso;
        document.getElementById("visNome").innerHTML = resposta['dados'].Nome;
        document.getElementById("visCategoria").innerHTML = resposta['dados'].Categoria;
        document.getElementById("visSubcategoria").innerHTML = resposta['dados'].Subcategoria;
        document.getElementById("visDescricao").innerHTML = resposta['dados'].Descricao;
        document.getElementById("visdata").innerHTML = resposta['dados'].Datadecriacao;
        document.getElementById("visimagem").innerHTML = resposta['dados'].imagem;
        document.getElementById("vispdf").innerHTML = resposta['dados'].pdf;
        document.getElementById("visvideo").innerHTML = resposta['dados'].video;
        //document.getElementById("visprova").innerHTML = resposta['dados'].prova;
    }

}

async function editInternoDados(ID_curso){
    msgAlertaErroEdit.innerHTML = "";

    const dados = await fetch('visualizar.php?ID_curso=' + ID_curso);
    const resposta = await dados.json();
    console.log(resposta);

    if(resposta['erro']){
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const editModal = new bootstrap.Modal(document.getElementById("editInternoModal"));
        editModal.show();
        document.getElementById("editId").value  = resposta['dados'].ID_curso;
        document.getElementById("editNome").value  = resposta['dados'].Nome;
        document.getElementById("editCategoria").value  = resposta['dados'].Categoria;
        document.getElementById("editSubcategoria").value  = resposta['dados'].Subcategoria;
        document.getElementById("editDescricao").value  = resposta['dados'].Descricao;
        document.getElementById("editDatadecriacao").value  = resposta['dados'].Datadecriacao;
        //document.getElementById("editimagem").value  = resposta['dados'].imagem;
        //document.getElementById("editprova").value  = resposta['dados'].prova;
    }
}

editForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    document.getElementById("edit-externo-btn").value = "Salvando...";

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
        listarInterno(1);
    }

    document.getElementById("edit-externo-btn").value = "Salvar";
});

async function apagarInternoDados(ID_curso){
    //console.log("Acessou a função: " + ID_parceiro);
    var confirmar = confirm("Tem certeza que deseja excluir o registro selecionado?");

    if(confirmar == true){    
        const dados = await fetch('apagar.php?ID_curso= ' + ID_curso);

        const resposta = await dados.json();
        if(resposta['erro']){
            msgAlerta.innerHTML = resposta['msg'];
        }else{
            msgAlerta.innerHTML = resposta['msg'];
            listarInterno(1);
        }
    }
}

// Função para listar cursos por categoria
const listarCursosPorCategoria = async (categoria) => {
    const dados = await fetch("./lista.php?pagina=1&categoria=" + categoria);
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