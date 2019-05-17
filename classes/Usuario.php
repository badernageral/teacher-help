<?php
class Usuario extends Conexao{
    public function __construct(){
        $this->conectar();
    }
    public function login($usuario,$senha){
        $consulta = $this->conexao->prepare("SELECT id_usuario, nivel FROM usuarios WHERE usuario=:p1 AND senha=:p2");
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
        $consulta = $this->conexao->prepare("INSERT INTO usuarios VALUES(0,:p1,:p2,:p3,null,:p4)");
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
        $consulta = $this->conexao->prepare("SELECT * FROM usuarios where ajuda is not null order by ajuda ASC");
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
        $consulta = $this->conexao->prepare("UPDATE usuarios SET ajuda=NOW() WHERE id_usuario=:p1");
        $consulta->bindValue(":p1",$_SESSION["id_usuario"]);
        $consulta->execute();
        $consulta = $this->conexao->prepare("INSERT INTO log VALUES(0,:p1,NOW(),null,null)");
        $consulta->bindValue(":p1",$_SESSION["id_usuario"]);
        $consulta->execute();
    }
    public function finalizarAtendimento($id_usuario){
        $consulta = $this->conexao->prepare("UPDATE usuarios SET ajuda=null WHERE id_usuario=:p1");
        $consulta->bindValue(":p1",$id_usuario);
        $consulta->execute();
        $consulta = $this->conexao->prepare("UPDATE log SET id_usuario_finalizou=:p1, data_finalizacao=NOW() WHERE id_usuario_solicitou=:p2 AND id_usuario_finalizou IS NULL");
        $consulta->bindValue(":p1",$_SESSION["id_usuario"]);
        $consulta->bindValue(":p2",$id_usuario);
        $consulta->execute();
    }
}
