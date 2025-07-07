<div class="container p-5"> 
    <form action="./php/category.php" method="POST" class="ajaxform">
        <h1 class="title">Crear Nueva Categoría</h1>
        <p class="subtitle">Complete el formulario para crear una nueva categoría.</p>
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
    <input type="hidden" name="action" value="save_category">
</form>
</div>