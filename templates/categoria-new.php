<?php
?>
<div class="container p-5">
    <form action="save_category.php" method="POST">
    <div class="field">
        <label class="label">Nombre de la Categoría</label>
        <div class="control">
            <input class="input" type="text" name="nombre" placeholder="Ingrese el nombre de la categoría" required autocomplete="off">
        </div>
    </div>
    <div class="field">
        <label class="label">Descripción</label>
        <div class="control">
            <textarea class="textarea" name="descripcion" placeholder="Ingrese una descripción"></textarea>
        </div>
    </div>
    <div class="field is-grouped">
        <div class="control">
            <button class="button is-link" type="submit">Crear</button>
        </div>
        <div class="control">
            <a class="button is-light" href="index.php">Cancelar</a>
        </div>
    </div>
</form>
</div>