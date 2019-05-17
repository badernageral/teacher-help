<?php
class Conexao{
    // Você deve alterar esses dados
    private $servidor = "localhost";
    private $usuario = "root";
    private $senha = "aluno";
    // Somente os dados acima!
    private $banco = "teacher-help";
    public $conexao;
    public function conectar(){
        $this->conexao = new PDO("mysql:host=".$this->servidor.";dbname=".$this->banco, $this->usuario, $this->senha);
        $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function conectarSemBanco(){
        $this->conexao = new PDO("mysql:host=".$this->servidor, $this->usuario, $this->senha);
        $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
