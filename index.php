<?php
include "conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Help</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div id="site">
        <?php
        if(isset($_SESSION["id_usuario"])){
            ?>
            <a style="margin-top:5px;float:right;" href="sair.php">Sair</a>
            <a style="margin-top:5px;float:right;border-right: 1px solid #000;padding-right: 10px;margin-right:10px;" href="index.php?arquivo=alterar_formulario">Meus dados</a>
            <hr style="margin-top: 35px;margin-bottom:15px">
            <?php
            $arquivo = $_GET["arquivo"] ?? "listar";
            include $arquivo.".php";
        }else{
            include "login.php";
        }
        ?>
    </div>
</body>
</html>
