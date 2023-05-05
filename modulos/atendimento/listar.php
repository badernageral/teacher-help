<?php
$resultado = (new Usuario())->listarAtendimentos();
$pediu = false;
if(count($resultado)>0){
    ?>
    <table>
        <tr>
            <th id="ranking"></th>
            <th>Nome</th>
            <th>Hora</th>
            <th>Ações</th>
        </tr>
        <?php
        $i=1;
        foreach($resultado as $linha){
            echo "<tr>";
            echo "<td>".$i."º</td>";
            echo "<td>".$linha["nome_usuario"]."</td>";
            echo "<td>".DateTime::createFromFormat('Y-m-d H:i:s', $linha["data_solicitacao"])->format("d/m/Y H:i:s")."</td>";
            echo "<td class='centro'>";
            if(Usuario::isProfessor()){
                echo "<a id='link_excluir' href='index.php?arquivo=atendimento/excluir&usuario=".$linha["nome_usuario"]."'>&nbsp;</a>";
            }else if($linha["nome_usuario"]==$_SESSION["usuario"]){
                $pediu = true;
                echo "<a id='link_excluir' href='index.php?arquivo=atendimento/excluir'>&nbsp;</a>";
            } 
            echo "</td>";
            echo "</tr>";
            $i++;
        }
        ?>
</table>
<?php
}else{
    echo "<figure><img src='publico/imagens/lista_vazia.svg'><figcaption>Professor</figcaption></figure>";
}
if($_SESSION["nivel"]=="Aluno"){
    if(!$pediu){
?>
        <a id="pedirAjuda" href="index.php?arquivo=atendimento/cadastrar">Pedir <img src="publico/imagens/ajuda.svg"> ajuda!</a>
<?php
    }
}
?>
<script>
setInterval(atualizar, 5000);
function atualizar(){
    location.href="index.php";
}
</script>
