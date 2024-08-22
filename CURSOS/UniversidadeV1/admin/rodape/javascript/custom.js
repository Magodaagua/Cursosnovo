const tbody = document.querySelector(".listar-rodape");
const editForm = document.getElementById("edit-rodape-form");
const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");
const msgAlertaErroEdit = document.getElementById("msgAlertaErroEdit");
const msgAlerta = document.getElementById("msgAlerta");
//const cadModal = new bootstrap.Modal(document.getElementById("cadMenuModal"));

const listarRodape = async (pagina) => {
    const dados = await fetch("./lista.php?pagina=" + pagina);
    const resposta = await dados.text();
    tbody.innerHTML = resposta;
}

listarRodape(1);

async function visRodape(ID_rodape) {
    //console.log("Acessou: " + id);
    const dados = await fetch('visualizar.php?ID_rodape=' + ID_rodape);
    const resposta = await dados.json();
    //console.log(resposta);

    if (resposta['erro']) {
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const visModal = new bootstrap.Modal(document.getElementById("visRodapeModal"));
        visModal.show();

        document.getElementById("visID_rodape").innerHTML = resposta['dados'].ID_rodape;
        document.getElementById("vispolitica").innerHTML = resposta['dados'].politica;
        document.getElementById("vistermos").innerHTML = resposta['dados'].termos;
    }

}

async function editRodapeDados(ID_rodape){
    msgAlertaErroEdit.innerHTML = "";

    const dados = await fetch('visualizar.php?ID_rodape=' + ID_rodape);
    const resposta = await dados.json();
    console.log(resposta);

    if(resposta['erro']){
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const editModal = new bootstrap.Modal(document.getElementById("editRodapeModal"));
        editModal.show();
        document.getElementById("editRodape").value  = resposta['dados'].ID_rodape;
        document.getElementById("editPolitica").value  = resposta['dados'].politica;
        document.getElementById("editTermo").value  = resposta['dados'].termos;
    }
}

editForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    document.getElementById("edit-rodape-btn").value = "Salvando...";

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
        listarRodape(1);
    }

    document.getElementById("edit-rodape-btn").value = "Salvar";
});
