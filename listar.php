<?php
$consulta = $conexao->prepare("SELECT * FROM usuarios where ajuda is not null order by ajuda ASC"); 
$consulta->execute();
$resultado = $consulta->fetchAll();
$pediu = false;
if(count($resultado)>0){
    ?>
    <table>
        <tr>
            <th style="background-image:url('imagens/ranking.svg');background-size:25px;background-repeat:no-repeat;background-position:center center;"></th>
            <th>Nome</th>
            <th>Hora</th>
            <th>Ações</th>
        </tr>
        <?php
        $i=1;
        foreach($resultado as $linha){
            echo "<tr>";
            echo "<td>".$i."º</td>";
            echo "<td>".$linha["nome"]."</td>";
            echo "<td>".$linha["ajuda"]."</td>";
            echo "<td style='text-align:center'>";
            if($linha["id_usuario"]==$_SESSION["id_usuario"]){
                $pediu = true;
                echo "<a id='link_excluir' href='index.php?arquivo=excluir'>&nbsp;</a>";
            }
            if($_SESSION["nivel"]=="Professor"){
                echo "<a id='link_excluir' href='index.php?arquivo=excluir&id_usuario=".$linha["id_usuario"]."'>&nbsp;</a>";
            }
            echo "</td>";
            echo "</tr>";
            $i++;
        }
        ?>
</table>
<?php
}else{
    echo "<figure style='margin:0'><img style='width:70px;' src='imagens/lista_vazia.svg'><figcaption style='color:#007700;font-size:12px;'>Professor</figcaption></figure>";
}
if($_SESSION["nivel"]=="Aluno"){
    if(!$pediu){
?>
        <a id="pedirAjuda" href="index.php?arquivo=pedir_ajuda" style="">Pedir <img style="vertical-align:middle;" src="imagens/ajuda.svg"> ajuda!</a>
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
