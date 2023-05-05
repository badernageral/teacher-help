<?php
include "init.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Help</title>
    <link rel="stylesheet" href="publico/css/estilos.css">
    <script src="publico/javascript/funcoes.js"></script>
</head>
<body>
    <div id="site">
        <?php
        if(isset($_SESSION["usuario"])){
            echo '<nav>';
            if(Usuario::isProfessor()){
                echo '
                    <a href="index.php?arquivo=usuarios/listar">Usuários</a>
                    <a href="index.php?arquivo=meus_dados/alterar">Meus dados</a>';
            }
            echo '
                <a href="index.php?arquivo=atendimento/listar">Atendimento</a>
                <a href="sair.php">Sair</a>
            </nav>';
            $arquivo = $_GET["arquivo"] ?? "atendimento/listar";
            include "modulos/$arquivo.php";
        }else{
            if(isset($_GET["login"]) && $_GET["login"]=="professor"){
                include "login_professor.php";
            }else{
                include "login_aluno.php";
            }
        }
        ?>
    </div>
</body>
</html>
