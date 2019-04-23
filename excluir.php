<?php
include "conexao.php";   
if($_SESSION["nivel"]=="Professor"){
    $id_usuario = $_GET["id_usuario"];
}else{
    $id_usuario = $_SESSION["id_usuario"];
}
$consulta = $conexao->prepare("update usuarios set ajuda=null where id_usuario=:p1");
$consulta->bindValue(":p1",$id_usuario);
$consulta->execute();
$consulta = $conexao->prepare("UPDATE log SET id_usuario_finalizou=:p1, data_finalizacao=NOW() WHERE id_usuario_solicitou=:p2 AND id_usuario_finalizou IS NULL");
$consulta->bindValue(":p1",$_SESSION["id_usuario"]);
$consulta->bindValue(":p2",$id_usuario);
$consulta->execute();
header("Location: index.php?arquivo=listar");
?>
