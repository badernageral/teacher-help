<?php
if($_SESSION["nivel"]=="Professor"){
    $id = $_GET["id_usuario"];
}else{
    $id = $_SESSION["id_usuario"];
}
(new Usuario())->finalizarAtendimento($id);
header("Location: index.php?arquivo=atendimento/listar");
?>
