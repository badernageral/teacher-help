<?php
$objeto = new Usuario();
$resultado = $objeto->listar();
if($resultado){
    ?>
    <table>
        <tr>
            <th>Nome</th>
            <th>Tipo</th>
            <th><a id="link_cadastrar" href="index.php?arquivo=usuarios/cadastrar">&nbsp;</a></th>
        </tr>
        <?php
        foreach($resultado as $linha){
            echo "<tr>";
            echo "<td>".$linha["nome"]."</td>";
            echo "<td>".$linha["nivel"]."</td>";
            echo "<td class='centro'>";
                echo "<a id='link_alterar' href='index.php?arquivo=usuarios/alterar&id={$linha["id_usuario"]}'>&nbsp;</a> ";
                echo "<a id='link_excluir'  onclick='excluir(\"index.php?arquivo=usuarios/excluir&id={$linha["id_usuario"]}\")' href='#'>&nbsp;</a><br>";
                echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
<?php
}else{
    echo "<p>Nenhum usuário encontrado.</p>";
}
?>