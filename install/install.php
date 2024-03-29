<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Instalar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="install.css">
</head>
<body>
    <?php
    include "../classes/Conexao.php";
    $objeto = new Conexao();
    try{
        $objeto->conectarSemBanco();
    }catch(Exception $ex){
        echo "<p>Os dados para acesso ao banco estão incorretos.</p>
        <p>Altere-os no arquivo <b>Conexao.php</b> dentro da pasta <b>classes</b>!</p>";
        die();
    }
    try{
        $objeto->conexao->exec("CREATE DATABASE `teacher-help`");
        $objeto->conexao->exec("USE `teacher-help`");
        $objeto->conexao->exec("CREATE TABLE IF NOT EXISTS `teacher-help`.`usuarios` (
            `id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
            `nome` VARCHAR(50) NOT NULL,
            `usuario` VARCHAR(50) NOT NULL,
            `senha` VARCHAR(50) NOT NULL,
            `nivel` ENUM('Professor') NOT NULL DEFAULT 'Professor',
            PRIMARY KEY (`id_usuario`))
            ENGINE = InnoDB
            DEFAULT CHARACTER SET = utf8");
        $objeto->conexao->exec("CREATE TABLE IF NOT EXISTS `teacher-help`.`atendimentos` (
            `id_atendimento` INT(11) NOT NULL AUTO_INCREMENT,
            `nome_usuario` VARCHAR(255) NOT NULL,
            `data_solicitacao` DATETIME NOT NULL,
            `id_usuario_finalizou` INT(11) NULL DEFAULT NULL,
            `data_finalizacao` DATETIME NULL DEFAULT NULL,
            PRIMARY KEY (`id_atendimento`),
            INDEX `fk_log_usuarios1_idx` (`id_usuario_finalizou` ASC) VISIBLE,
            CONSTRAINT `fk_log_usuarios1`
              FOREIGN KEY (`id_usuario_finalizou`)
              REFERENCES `teacher-help`.`usuarios` (`id_usuario`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION)
          ENGINE = InnoDB
          DEFAULT CHARACTER SET = utf8");
        $objeto->conexao->exec("INSERT INTO usuarios VALUES
            (0,'Administrador','admin',MD5('admin'),'Professor')");
    }catch(Exception $ex){
        echo "<p>O banco já foi criado!</p>";
        die();
    }
    ?>
    <p>Banco de dados criado com sucesso!</p>
    <p>Usuário: admin</p>
    <p>Senha: admin</p>
    <p><a href="../adm/index.php">Login</a></p>
</body>
</html>
