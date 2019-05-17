function excluir(url){
    if(confirm("Confirma a exclusão?")){
        location.href = url;
    }
}
function verificarSenhas() {
    var senha = document.querySelector("#senha").value;
    var senha2 = document.querySelector("#senha2").value;
    var mensagem = document.querySelector("#mensagem");
    if (senha == '' || senha == senha2) {
        return true;
    } else {
        mensagem.style.display = "block";
        return false;
    }
}