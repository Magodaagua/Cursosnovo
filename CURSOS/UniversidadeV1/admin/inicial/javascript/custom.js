const tbody = document.querySelector(".listar-menu");
const editForm = document.getElementById("edit-menu-form");
const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");
const msgAlertaErroEdit = document.getElementById("msgAlertaErroEdit");
const msgAlerta = document.getElementById("msgAlerta");
//const cadModal = new bootstrap.Modal(document.getElementById("cadMenuModal"));

const listarMenu = async (pagina) => {
    const dados = await fetch("./lista.php?pagina=" + pagina);
    const resposta = await dados.text();
    tbody.innerHTML = resposta;
}

listarMenu(1);

async function visMenu(ID_menu) {
    //console.log("Acessou: " + id);
    const dados = await fetch('visualizar.php?ID_menu=' + ID_menu);
    const resposta = await dados.json();
    //console.log(resposta);

    if (resposta['erro']) {
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const visModal = new bootstrap.Modal(document.getElementById("visMenuModal"));
        visModal.show();

        document.getElementById("visID_menu").innerHTML = resposta['dados'].ID_menu;
        document.getElementById("vistexto1").innerHTML = resposta['dados'].texto1;
        document.getElementById("vistexto2").innerHTML = resposta['dados'].texto2;
        document.getElementById("vistexto3").innerHTML = resposta['dados'].texto3;
        document.getElementById("vistitulo1").innerHTML = resposta['dados'].titulo1;
        document.getElementById("vistitulo2").innerHTML = resposta['dados'].titulo2;
        document.getElementById("vistitulo3").innerHTML = resposta['dados'].titulo3;
        document.getElementById("visimagem1").innerHTML = resposta['dados'].imagem1;
        document.getElementById("visimagem2").innerHTML = resposta['dados'].imagem2;
        document.getElementById("visimagem3").innerHTML = resposta['dados'].imagem3;
        document.getElementById("viscarrosel1").innerHTML = resposta['dados'].carrosel1;
        document.getElementById("viscarrosel2").innerHTML = resposta['dados'].carrosel2;
        document.getElementById("viscarrosel3").innerHTML = resposta['dados'].carrosel3;
    }

}

async function editMenuDados(ID_menu){
    msgAlertaErroEdit.innerHTML = "";

    const dados = await fetch('visualizar.php?ID_menu=' + ID_menu);
    const resposta = await dados.json();
    //console.log(resposta);

    if(resposta['erro']){
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const editModal = new bootstrap.Modal(document.getElementById("editMenuModal"));
        editModal.show();
        document.getElementById("editId").value = resposta['dados'].ID_menu;
        document.getElementById("editTexto1").value = resposta['dados'].texto1;
        document.getElementById("editTexto2").value = resposta['dados'].texto2;
        document.getElementById("editTexto3").value = resposta['dados'].texto3;
        document.getElementById("editTitulo1").value = resposta['dados'].titulo1;
        document.getElementById("editTitulo2").value = resposta['dados'].titulo2;
        document.getElementById("editTitulo3").value = resposta['dados'].titulo3;
        //document.getElementById("editImagem1").value = resposta['dados'].imagem1;
        //document.getElementById("editImagem2").value = resposta['dados'].imagem2;
        //document.getElementById("editImagem3").value = resposta['dados'].imagem3;
        //document.getElementById("editImagem1").value = resposta['dados'].carrosel1;
        //document.getElementById("editImagem2").value = resposta['dados'].carrosel2;
        //document.getElementById("editImagem3").value = resposta['dados'].carrosel3;
        //document.getElementById("editprova").value  = resposta['dados'].prova;
    }
}

editForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    document.getElementById("edit-menu-btn").value = "Salvando...";

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
        listarMenu(1);
    }

    document.getElementById("edit-menu-btn").value = "Salvar";
});
