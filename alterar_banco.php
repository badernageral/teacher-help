<?php
include "conexao.php";
if(isset($_POST["senha"]) && $_POST["senha"]!=""){
    $consulta = $conexao->prepare("UPDATE usuarios SET usuario=:usuario, senha=:senha WHERE id_usuario=:id_usuario");
    $consulta->bindValue(":senha",md5($_POST["senha"]));
}else{
    $consulta = $conexao->prepare("UPDATE usuarios SET usuario=:usuario WHERE id_usuario=:id_usuario");
}
$consulta->bindValue(":id_usuario",$_SESSION["id_usuario"]);
$consulta->bindValue(":usuario",$_POST["usuario"]);
$consulta->execute();
header("Location: index.php?arquivo=listar");
?>
