<?php 
    $p = $palestra->getPalestra($id);
?>


<form action="?page=alterar" method="post">
    <input type="hidden" name="id" value="<?= $p->id ?>" >
    <p><label>Título:</label> <input type="text" name="titulo" required value="<?= $p->titulo ?>"></p>
    <p><label>Palestrante: </label><input type="text" name="palestrante" required value="<?= $p->palestrante ?>"></p>
    <p><label>Data: </label><input type="date" name="data" required value="<?= $p->data ?>"></p>
    <p><label>Hora: </label><input type="time" name="hora" required value="<?= $p->hora ?>"></p>
    <p class="center"><input type="submit" name="bt_salvar" value="Cadastrar" ></p>
</form>