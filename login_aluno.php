<form id="login" action="" method="post">
    <img src="publico/imagens/help.png">
    <div><input type="text" name="nome" placeholder="Insira seu nome..."></div>
    <div><button type="submit">Entrar</button></div>
</form>
<?php
if($_POST){
    $_SESSION["usuario"] = $_POST["nome"];
    $_SESSION["nivel"] = "Aluno";
    echo "<script>location.href='index.php';</script>";
}
?>
