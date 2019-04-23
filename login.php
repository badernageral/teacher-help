<form action="" method="post" style="text-align: center;">
    <img style="width: 80%;margin-bottom:10px" src="imagens/help.png">
    <div style="text-align:center"><input style="font-size:18px;" type="text" name="usuario" placeholder="Usuário"></div>
    <div style="text-align:center;"><input style="font-size:18px;" type="password" name="senha" placeholder="Senha"></div>
    <div style="text-align:center;"><button style="width:80%;font-size:20px;" type="submit">Entrar</button></div>
</form>
<?php
if($_POST){
    $nome = $_POST["usuario"];
    $senha = $_POST["senha"];
    $consulta = $conexao->prepare("SELECT id_usuario, nivel FROM usuarios WHERE usuario=:p1 AND senha=:p2");
    $consulta->bindValue(":p1",$nome);
    $consulta->bindValue(":p2",md5($senha));
    $consulta->execute();
    $resultado = $consulta->fetch();
    if($resultado){
        $_SESSION["id_usuario"] = $resultado["id_usuario"];
        $_SESSION["nivel"] = $resultado["nivel"];
        echo "<script>location.href='index.php?arquivo=listar';</script>";
    }else{
        echo "<div style='text-align:center;color:red;'>Usuário e/ou senha inválidos!</div>";
    }
}
?>
