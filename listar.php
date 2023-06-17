    


<div class="center">
<?php 
$listaPalestra = $palestra->getPalestras();
if(empty($listaPalestra)){
    echo "<h2>Não existem palestras cadastradas. Cadastre uma palestra.</h2>";
}else{
    echo "<h2>Existem palestras cadastradas</h2>";
    echo "<table class='center'>";
    echo "<tr><th>Título</th> <th>Palestrante</th> <th> Data</th> <th> Hora</th></tr>";
    foreach($listaPalestra as $p){
        echo "<tr><td>$p->titulo</td> <td>$p->palestrante</td> <td> $p->data</td> <td> $p->hora</td></tr>";  
    }
    echo "</table>";
}

?>
</div>