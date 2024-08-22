const tbody = document.querySelector(".listar-administrador");
const cadForm = document.getElementById("cad-administrador-form");
const editForm = document.getElementById("edit-administrador-form");
const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");
const msgAlertaErroEdit = document.getElementById("msgAlertaErroEdit");
const msgAlerta = document.getElementById("msgAlerta");
const cadModal = new bootstrap.Modal(document.getElementById("cadAdministradorModal"));

const listarAdministrador = async (pagina) => {
    const dados = await fetch("./lista.php?pagina=" + pagina);
    const resposta = await dados.text();
    tbody.innerHTML = resposta;
}

listarAdministrador(1);

cadForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    
    const dadosForm = new FormData(cadForm);
    dadosForm.append("add", 1);

    document.getElementById("cad-administrador-btn").value = "Salvando...";
    
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
        listarAdministrador(1);
    }
    document.getElementById("cad-administrador-btn").value = "Cadastrar";
});


async function visAdministrador($ID_admin) {
    //console.log("Acessou: " + id);
    const dados = await fetch('visualizar.php?ID_admin=' + $ID_admin);
    const resposta = await dados.json();
    console.log(resposta);

    if (resposta['erro']) {
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const visModal = new bootstrap.Modal(document.getElementById("visAdministradorModal"));
        visModal.show();

        document.getElementById("visID").innerHTML = resposta['dados'].ID_admin;
        document.getElementById("visEmail").innerHTML = resposta['dados'].email;
        document.getElementById("visSenha").innerHTML = resposta['dados'].senha;
    }

}

async function editAdministradorDados(ID_admin){
    msgAlertaErroEdit.innerHTML = "";

    const dados = await fetch('visualizar.php?ID_admin=' + ID_admin);
    const resposta = await dados.json();
    console.log(resposta);

    if(resposta['erro']){
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const editModal = new bootstrap.Modal(document.getElementById("editAdministradorModal"));
        editModal.show();
        document.getElementById("editId").value  = resposta['dados'].ID_admin;
        document.getElementById("editEmail").value  = resposta['dados'].email;
        document.getElementById("editSenha").value  = resposta['dados'].senha;
    }
}

editForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    document.getElementById("edit-administrador-btn").value = "Salvando...";

    const dadosForm = new FormData(editForm);
    //console.log(dadosForm);
    /*for (var dadosFormEdit of dadosForm.entries()){
        console.log(dadosFormEdit[0] + " - " + dadosFormEdit[1]);
    }*/

    const dados = await fetch("editar.php", {
        method: "POST",
        body:dadosForm
    });

    //console.log(dados);
    const resposta = await dados.json();
    //console.log(resposta);

    if(resposta['erro']){
        msgAlertaErroEdit.innerHTML = resposta['msg'];
    }else{
        msgAlertaErroEdit.innerHTML = resposta['msg'];
        listarAdministrador(1);
    }

    document.getElementById("edit-administrador-btn").value = "Salvar";
});

async function apagarAdministradorDados($ID_admin){
    //console.log("Acessou a função: " + ID_parceiro);
    var confirmar = confirm("Tem certeza que deseja excluir o registro selecionado?");

    if(confirmar == true){    
        const dados = await fetch('apagar.php?ID_admin= ' + $ID_admin);

        const resposta = await dados.json();
        if(resposta['erro']){
            msgAlerta.innerHTML = resposta['msg'];
        }else{
            msgAlerta.innerHTML = resposta['msg'];
            listarAdministrador(1);
        }
    }
}