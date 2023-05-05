<?php
if($_POST){
    $u = new Usuario();
    $u->alterarMeusDados($_POST);
    echo '<script>location.href="index.php?arquivo=atendimento/listar"</script>';
}else{
    $linha = (new Usuario())->consultar($_SESSION["id_usuario"]);
?>
<form action="" method="post" onsubmit="return verificarSenhas()">
    <label>
        Usuário: <input type="text" name="usuario" value="<?=$linha["usuario"]?>" required>
    </label>
    <label>
        Senha: <input id="senha" type="password" name="senha">
    </label>
    <label>
        Confirmar: <input id="senha2" type="password" name="senha2">
    </label>
    <label id="mensagem" style="display:none">Senhas não conferem!</label>
    <label>
        <button type="submit">Alterar</button>
    </label>
</form>
<?php
}
?>