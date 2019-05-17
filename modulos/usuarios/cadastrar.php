<?php
if($_POST){
    $objeto = new Usuario();
    $objeto->cadastrar($_POST);
    header("Location: index.php?arquivo=usuarios/listar");
}else{
?>
<form action="" method="post" onsubmit="return verificarSenhas()">
    <label>
        Tipo: <select name="nivel" required>
            <option value="">Selecione</option>
            <option value="Aluno">Aluno</option>
            <option value="Professor">Professor</option>
        </select>
    </label>
    <label>
        Nome: <input type="text" name="nome" required>
    </label>
    <label>
        Usuário: <input type="text" name="usuario" required>
    </label>
    <label>
        Senha: <input id="senha" type="password" name="senha" required>
    </label>
    <label>
        Confirmar: <input id="senha2" type="password" name="senha2" required>
    </label>
    <label id="mensagem" style="display:none">Senhas não conferem!</label>
    <label>
        <button type="submit">Cadastrar</button>
    </label>
</form>
<?php
}
?>