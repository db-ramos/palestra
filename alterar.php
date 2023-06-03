<form action="?page=alterar" method="post">
<?php 
$listaPalestra = $palestra->getPalestras();
if(empty($listaPalestra)){
    echo "<h2>Não existem palestras cadastradas. Cadastre uma palestra.<h2>";
}else{
    echo "<h2>Existem palestras cadastradas</h2>";
    foreach($listaPalestra as $p){
        echo "<p>";
        echo "<input type='radio' name='id' value='$p->id' id='opcao$p->id'>";
        echo "<label for='opcao$p->id'>";
        echo "Palestra: $p->titulo, $p->palestrante, $p->data, $p->hora";
        echo "</p>";  
    }
    echo "<p><input type='submit' name='bt_excluir' value='Excluir'></p>";
}

?>
    
</form>