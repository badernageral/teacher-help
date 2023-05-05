<?php
if($_POST){
    $objeto = new Usuario();
    $objeto->alterar($_POST);
    echo '<script>location.href="index.php?arquivo=usuarios/listar"</script>';
}else{
    $id_usuario = $_GET["id"];
    $linha = (new Usuario())->consultar($id_usuario);
?>
<form action="" method="post" onsubmit="return verificarSenhas()">
    <label>
        Tipo: <select name="nivel" required>
            <option <?php if($linha["nivel"]=="Professor") echo "selected"; ?> value="Professor">Professor</option>
        </select>
    </label>
    <label>
        Nome: <input type="text" name="nome" value="<?=$linha["nome"]?>" required>
    </label>
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
    <input type="hidden" name="id_usuario" value="<?=$id_usuario?>">
    <label>
        <button type="submit">Alterar</button>
    </label>
</form>
<?php
}
?>