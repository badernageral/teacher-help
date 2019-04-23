<?php
session_start();
$servidor = "localhost";
$usuario = "root";
$senha = "aluno";
$banco = "help";
$conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
?>
