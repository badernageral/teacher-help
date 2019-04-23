<?php
$consulta = $conexao->prepare("update usuarios set ajuda=NOW() where id_usuario=:p1");
$consulta->bindValue(":p1",$_SESSION["id_usuario"]);
$consulta->execute();
$consulta = $conexao->prepare("INSERT INTO log VALUES(0,:p1,NOW(),null,null)");
$consulta->bindValue(":p1",$_SESSION["id_usuario"]);
$consulta->execute();
?>
<script>location.href='index.php?arquivo=listar';</script>