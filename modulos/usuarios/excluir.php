<?php
$objeto = new Usuario();
$objeto->excluir($_GET["id"]);
header("Location: index.php?arquivo=usuarios/listar");
?>