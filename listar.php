


<div class="center">
<?php 
$listaPalestra = $palestra->getPalestras();
if(empty($listaPalestra)){
    echo "<h2>Não existem palestras cadastradas. Cadastre uma palestra.</h2>";
}else{
    echo "<h2>Existem palestras cadastradas</h2>";
    foreach($listaPalestra as $p){
        echo "<p>Palestra: $p->titulo, $p->palestrante, $p->data, $p->hora</p>";  
    }
}

?>
</div>