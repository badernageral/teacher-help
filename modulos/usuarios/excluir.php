<?php
$objeto = new Usuario();
$objeto->excluir($_GET["id"]);
echo '<script>location.href="index.php?arquivo=usuarios/listar"</script>';
?>