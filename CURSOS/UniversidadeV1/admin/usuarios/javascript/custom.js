const tbody = document.querySelector(".listar-usuarios");
const cadForm = document.getElementById("cad-usuario-form");
const editForm = document.getElementById("edit-usuario-form");
const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");
const msgAlertaErroEdit = document.getElementById("msgAlertaErroEdit");
const msgAlerta = document.getElementById("msgAlerta");
const cadModal = new bootstrap.Modal(document.getElementById("cadUsuarioModal"));

const listarUsuarios = async (pagina) => {
    const dados = await fetch("./lista.php?pagina=" + pagina);
    const resposta = await dados.text();
    tbody.innerHTML = resposta;
}

listarUsuarios(1);

cadForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    
    const dadosForm = new FormData(cadForm);
    dadosForm.append("add", 1);

    document.getElementById("cad-usuario-btn").value = "Salvando...";
    
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
        listarUsuarios(1);
    }
    document.getElementById("cad-usuario-btn").value = "Cadastrar";
});


async function visUsuario(ID_usuario) {
    //console.log("Acessou: " + id);
    const dados = await fetch('visualizar.php?ID_usuario=' + ID_usuario);
    const resposta = await dados.json();
    //console.log(resposta);

    if (resposta['erro']) {
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const visModal = new bootstrap.Modal(document.getElementById("visUsuarioModal"));
        visModal.show();

        document.getElementById("visID_usuario").innerHTML = resposta['dados'].ID_usuario;
        document.getElementById("visNome").innerHTML = resposta['dados'].Nome;
        document.getElementById("viscpf").innerHTML = resposta['dados'].CPF;
        document.getElementById("visrg").innerHTML = resposta['dados'].RG;
        document.getElementById("viscargo").innerHTML = resposta['dados'].Cargo;
        document.getElementById("visemail").innerHTML = resposta['dados'].email;
        document.getElementById("vissenha").innerHTML = resposta['dados'].senha;

    }

}

async function editUsuarioDados(ID_usuario){
    msgAlertaErroEdit.innerHTML = "";

    const dados = await fetch('visualizar.php?ID_usuario=' + ID_usuario);
    const resposta = await dados.json();
    console.log(resposta);

    if(resposta['erro']){
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const editModal = new bootstrap.Modal(document.getElementById("editUsuarioModal"));
        editModal.show();
        document.getElementById("editId").value  = resposta['dados'].ID_usuario;
        document.getElementById("editNome").value  = resposta['dados'].Nome;
        document.getElementById("editCPF").value  = resposta['dados'].CPF;
        document.getElementById("editRG").value  = resposta['dados'].RG;
        document.getElementById("editcargo").value  = resposta['dados'].Cargo;
        document.getElementById("editemail").value  = resposta['dados'].email;
        document.getElementById("editsenha").value  = resposta['dados'].senha;
    }
}

editForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    document.getElementById("edit-usuario-btn").value = "Salvando...";

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
        listarUsuarios(1);
    }

    document.getElementById("edit-usuario-btn").value = "Salvar";
});

async function apagarUsuarioDados(ID_usuario){
    //console.log("Acessou a função: " + ID_parceiro);
    var confirmar = confirm("Tem certeza que deseja excluir o registro selecionado?");

    if(confirmar == true){    
        const dados = await fetch('apagar.php?ID_usuario= ' + ID_usuario);

        const resposta = await dados.json();
        if(resposta['erro']){
            msgAlerta.innerHTML = resposta['msg'];
        }else{
            msgAlerta.innerHTML = resposta['msg'];
            listarUsuarios(1);
        }
    }
}

// Função para listar usuários por categoria
const listarUsuariosPorCategoria = async (categoria, pagina) => {
    const dados = await fetch(`./lista.php?pagina=${pagina}&categoria=${categoria}`);
    const resposta = await dados.text();
    tbody.innerHTML = resposta;
}

// Evento de envio do formulário de seleção de categoria
const categoriaForm = document.getElementById("categoria-form");
categoriaForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const selectedCategoria = document.getElementById("id_categoria").value;
    
    // Define a página inicial (1) ao selecionar uma nova categoria
    listarUsuariosPorCategoria(selectedCategoria, 1);
});
