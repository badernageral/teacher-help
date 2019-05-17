<form id="login" action="" method="post">
    <img src="publico/imagens/help.png">
    <div><input type="text" name="usuario" placeholder="Usuário"></div>
    <div><input type="password" name="senha" placeholder="Senha"></div>
    <div><button type="submit">Entrar</button></div>
</form>
<?php
if($_POST){
    $u = new Usuario();
    $resultado = $u->login($_POST["usuario"],$_POST["senha"]);
    if($resultado){
        $_SESSION["id_usuario"] = $resultado["id_usuario"];
        $_SESSION["nivel"] = $resultado["nivel"];
        echo "<script>location.href='index.php';</script>";
    }else{
        echo "<div class='mensagem_erro'>Usuário e/ou senha inválidos!</div>";
    }
}
?>
