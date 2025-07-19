<div class="container p-5"> 
    <form action="./php/category.php" method="POST" class="ajaxform" id="category_new">
        <h1 class="title">Crear Nueva Categoría</h1>
        <p class="subtitle">Complete el formulario para crear una nueva categoría.</p>
    <div class="field">
        <label class="label">Nombre de la Categoría</label>
        <div class="control">
            <input class="input" type="text" name="nombre" placeholder="Ingrese el nombre de la categoría" required autocomplete="off" pattern="<?php echo get_regex_patterns('onlyspaces_html'); ?>" title="El nombre debe tener entre 3 y 50 caracteres alfanuméricos." maxlength="100">
        </div>
        <div class="preview-slug py-5"></div>
    </div>
    <div class="field">
        <label class="label">Descripción</label>
        <div class="control">
            <textarea class="textarea" name="descripcion" placeholder="Ingrese una descripción" pattern="<?php echo get_regex_patterns('onlyspaces_html'); ?>" title="La descripción debe tener entre 3 y 50 caracteres alfanuméricos." maxlength="100" autocomplete="off"></textarea>
        </div>
    </div>
    <div class="field is-grouped">
        <div class="control">
            <button class="button is-link" type="submit">Crear</button>
        </div>
        <div class="control">
            <button type="button" class="button is-light" id="cat_cancel">Cancelar</button>
        </div>
    </div>
    <input type="hidden" name="slug" id="slug" value="" pattern="<?php echo get_regex_patterns('alfanum_guion_html'); ?>" maxlength="100" title="El slug debe contener solo caracteres alfanuméricos y guiones, y no debe estar vacío.">
    <input type="hidden" name="action" value="save_category">
</form>
<div class="notification is-info notice-msg" style="display:none;" id="error-notification"></div>
</div>