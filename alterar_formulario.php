<?php
$consulta = $conexao->prepare("SELECT * FROM usuarios WHERE id_usuario=:id_usuario");
$consulta->bindValue(":id_usuario",$_SESSION["id_usuario"]);
$consulta->execute();
$linha = $consulta->fetch();
?>
<form action="alterar_banco.php" method="post" onsubmit="return verificar()">
    <label>
        Usuário: <input style="width:70%" type="text" name="usuario" value="<?=$linha["usuario"]?>" required>
    </label>
    <label>
        Senha: <input id="senha" style="width:70%" type="password" name="senha">
    </label>
    <label>
        Confirmar: <input style="width:70%" id="senha2" type="password" name="senha2">
    </label>
    <label id="mensagem" style="display:none">Senhas não conferem!</label>
    <label>
        <button type="submit">Alterar</button>
    </label>
</form>
<script>
function verificar(){
    var senha = document.querySelector("#senha").value;
    var senha2 = document.querySelector("#senha2").value;
    var mensagem = document.querySelector("#mensagem");
    if(senha==''){
        return true;
    }else if(senha==senha2){
        return true;
    }else{
        mensagem.style.display = "block";
        return false;
    }
}
</script>
