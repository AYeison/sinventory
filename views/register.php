
<?php 
include dirname(__DIR__) . '/inc/regex.php'; 
?>
<section class="section">
    <div class="container">
        <h1 class="title">Registro de Usuario</h1>
        <form action="./php/register_process.php" method="POST" class='ajaxform'>
            <div class="field">
                <label class="label">Nombre de usuario</label>
                <div class="control">
                    <input class="input" type="text" name="username" required pattern="<?php echo trim(get_regex_patterns('username_html'), '/'); ?>" maxlength="50">
                </div>
            </div>
            <div class="field">
                <label class="label">Correo electrónico</label>
                <div class="control">
                    <input class="input" type="email" name="email" required pattern="<?php echo trim(get_regex_patterns('email_html'), '/'); ?>" maxlength="100">
                </div>
            </div>
            <div class="field">
    <label class="label">Contraseña</label>
    <div class="control has-icons-right position-relative">
        <input class="input" type="password" name="password" id="password-input" required pattern="<?php echo trim(get_regex_patterns('password_html'), '/'); ?>" maxlength="50">

        <div  style="cursor:pointer;z-index: 30; position: absolute; right: 10px; top: 50%; transform: translateY(-50%); width:40px; height: 40px;"  id="toggle-password">
            <span class="icon is-small is-right" id="toggle-password-icon">
            <i class="fas fa-eye"></i>
        </span>
        </div>
    </div>
</div>
            <div class="field">
                <div class="control">
                    <button class="button is-primary" type="submit">Registrarse</button>
                </div>
            </div>
            <input type="hidden" name="action" value="register">
        </form>
    <div class="notification is-danger is-light errorAjax" style="display: none;" id="error-notification">
        <!-- Mensaje de error aquí -->
    </div>
</section>
