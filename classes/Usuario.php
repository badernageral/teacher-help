<?php
class Usuario extends Conexao{
    public function __construct(){
        $this->conectar();
    }
    public function login($usuario,$senha){
        $consulta = $this->conexao->prepare("SELECT id_usuario, nivel, usuario FROM usuarios WHERE usuario=:p1 AND senha=:p2");
        $consulta->bindValue(":p1",$usuario);
        $consulta->bindValue(":p2",md5($senha));
        $consulta->execute();
        return $consulta->fetch();
    }
    public static function isProfessor(){
        return $_SESSION["nivel"]=="Professor";
    }
    public static function isAluno(){
        return $_SESSION["nivel"]=="Aluno";
    }
    public function cadastrar($valores){
        $consulta = $this->conexao->prepare("INSERT INTO usuarios VALUES(0,:p1,:p2,:p3,:p4)");
        $consulta->bindValue(":p1", $valores["nome"]);
        $consulta->bindValue(":p2", $valores["usuario"]);
        $consulta->bindValue(":p3", md5($valores["senha"]));
        $consulta->bindValue(":p4", $valores["nivel"]);
        $consulta->execute();
    }
    public function alterar($valores){
        $sql = "UPDATE usuarios SET usuario=:usuario, nome=:nome, nivel=:nivel";
        if(isset($valores["senha"]) && $valores["senha"]!=""){
            $consulta = $this->conexao->prepare("$sql, senha=:senha WHERE id_usuario=:id_usuario");
            echo $valores["senha"];
            $consulta->bindValue(":senha",md5($valores["senha"]));
        }else{
            $consulta = $this->conexao->prepare("$sql WHERE id_usuario=:id_usuario");
        }
        $consulta->bindValue(":id_usuario",$valores["id_usuario"]);
        $consulta->bindValue(":usuario",$valores["usuario"]);
        $consulta->bindValue(":nome",$valores["nome"]);
        $consulta->bindValue(":nivel",$valores["nivel"]);
        $consulta->execute();
    }
    public function alterarMeusDados($valores){
        if(isset($valores["senha"]) && $valores["senha"]!=""){
            $consulta = $this->conexao->prepare("UPDATE usuarios SET usuario=:usuario, senha=:senha WHERE id_usuario=:id_usuario");
            $consulta->bindValue(":senha",md5($valores["senha"]));
        }else{
            $consulta = $this->conexao->prepare("UPDATE usuarios SET usuario=:usuario WHERE id_usuario=:id_usuario");
        }
        $consulta->bindValue(":id_usuario",$_SESSION["id_usuario"]);
        $consulta->bindValue(":usuario",$valores["usuario"]);
        $consulta->execute();
    }
    public function excluir($id){
        $consulta = $this->conexao->prepare("DELETE FROM usuarios WHERE id_usuario=:p1");
        $consulta->bindValue(":p1", $id);
        $consulta->execute();
    }
    public function listar(){
        $consulta = $this->conexao->prepare("SELECT * FROM usuarios");
        $consulta->execute();
        return $consulta->fetchAll();
    }
    public function listarAtendimentos(){
        $consulta = $this->conexao->prepare("SELECT * FROM atendimentos where data_finalizacao is null order by data_solicitacao ASC");
        $consulta->execute();
        return $consulta->fetchAll();
    }
    public function consultar($id){
        $consulta = $this->conexao->prepare("SELECT * FROM usuarios WHERE id_usuario=:p1");
        $consulta->bindValue(":p1", $id);
        $consulta->execute();
        return $consulta->fetch();
    }
    public function pedirAjuda(){
        $consulta = $this->conexao->prepare("INSERT INTO atendimentos VALUES(0,:p1,NOW(),null,null)");
        $consulta->bindValue(":p1",$_SESSION["usuario"]);
        $consulta->execute();
    }
    public function finalizarAtendimento(){
        if($_SESSION["nivel"]=="Professor"){
            $consulta = $this->conexao->prepare("UPDATE atendimentos SET data_finalizacao=NOW(), id_usuario_finalizou=:p2 WHERE nome_usuario=:p1 AND data_finalizacao IS NULL");
            $consulta->bindValue(":p1",$_GET["usuario"]);
            $consulta->bindValue(":p2",$_SESSION["id_usuario"]);
            $consulta->execute();
        }else{
            $consulta = $this->conexao->prepare("UPDATE atendimentos SET data_finalizacao=NOW() WHERE nome_usuario=:p1 AND data_finalizacao IS NULL");
            $consulta->bindValue(":p1",$_SESSION["usuario"]);
            $consulta->execute();
        }
    }
}
