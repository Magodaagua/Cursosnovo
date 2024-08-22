const tbody = document.querySelector(".listar-parceiros");
const cadForm = document.getElementById("cad-externo-form");
const editForm = document.getElementById("edit-externo-form");
const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");
const msgAlertaErroEdit = document.getElementById("msgAlertaErroEdit");
const msgAlerta = document.getElementById("msgAlerta");
const cadModal = new bootstrap.Modal(document.getElementById("cadExternoModal"));

const listarParceiros = async (pagina) => {
    const dados = await fetch("./lista.php?pagina=" + pagina);
    const resposta = await dados.text();
    tbody.innerHTML = resposta;
}

listarParceiros(1);

cadForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    
    const dadosForm = new FormData(cadForm);
    dadosForm.append("add", 1);

    document.getElementById("cad-externo-btn").value = "Salvando...";
    
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
        listarParceiros(1);
    }
    document.getElementById("cad-externo-btn").value = "Cadastrar";
});


async function visParceiro(ID_parceiro) {
    //console.log("Acessou: " + id);
    const dados = await fetch('visualizar.php?ID_parceiro=' + ID_parceiro);
    const resposta = await dados.json();
    //console.log(resposta);

    if (resposta['erro']) {
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const visModal = new bootstrap.Modal(document.getElementById("visParceiroModal"));
        visModal.show();

        document.getElementById("visID_parceiro").innerHTML = resposta['dados'].ID_parceiro;
        document.getElementById("visNome").innerHTML = resposta['dados'].Nome;
        document.getElementById("visDescricao").innerHTML = resposta['dados'].Descricao;
        document.getElementById("vislink").innerHTML = resposta['dados'].link;
        document.getElementById("visimagem").innerHTML = resposta['dados'].imagem;
    }

}

async function editParceiroDados(ID_parceiro){
    msgAlertaErroEdit.innerHTML = "";

    const dados = await fetch('visualizar.php?ID_parceiro=' + ID_parceiro);
    const resposta = await dados.json();
    console.log(resposta);

    if(resposta['erro']){
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const editModal = new bootstrap.Modal(document.getElementById("editExternoModal"));
        editModal.show();
        document.getElementById("editId").value  = resposta['dados'].ID_parceiro;
        document.getElementById("editNome").value  = resposta['dados'].Nome;
        document.getElementById("editDescricao").value  = resposta['dados'].Descricao;
        document.getElementById("editlink").value  = resposta['dados'].link;
        //document.getElementById("editimagem").value  = resposta['dados'].imagem;
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
        listarParceiros(1);
    }

    document.getElementById("edit-externo-btn").value = "Salvar";
});

async function apagarParceiroDados(ID_parceiro){
    //console.log("Acessou a função: " + ID_parceiro);
    var confirmar = confirm("Tem certeza que deseja excluir o registro selecionado?");

    if(confirmar == true){    
        const dados = await fetch('apagar.php?ID_parceiro= ' + ID_parceiro);

        const resposta = await dados.json();
        if(resposta['erro']){
            msgAlerta.innerHTML = resposta['msg'];
        }else{
            msgAlerta.innerHTML = resposta['msg'];
            listarParceiros(1);
        }
    }
}