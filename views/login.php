<?php 

include dirname(__DIR__) . '/inc/regex.php'; 


is_user_logged_redirect();

?>

<section class="section">
    <div class="container">
        <form action="./php/login_process.php" method="POST" class="box ajaxform" style="max-width: 400px; margin: auto;">
            <h2 class="title is-4 has-text-centered">Iniciar Sesión</h2>
            <div class="field">
                <label class="label" for="username">Usuario:</label>
                <div class="control">
                    <input class="input" type="text" id="username" name="username" pattern="<?php echo trim(get_regex_patterns('emailoruser'), '/'); ?>"  maxlength="50" required>
                </div>
            </div>
            <div class="field">
                <label class="label" for="password">Contraseña:</label>
                <div class="control">
                    <input class="input" type="password" id="password-input" name="password" pattern="<?php echo trim(get_regex_patterns('password_html'), '/'); ?>"  maxlength="50" required >
                    <div  style="cursor:pointer;z-index: 30; position: absolute; right: 10px; top: 50%; transform: translateY(-50%); width:25px; height: 25px;"  id="toggle-password">
                          <span class="icon is-small is-right" id="toggle-password-icon">
                          <i class="fas fa-eye"></i>
                      </span>
                      </div>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button class="button is-primary is-fullwidth" type="submit">Ingresar</button>
                </div>
            </div>

            <input type="hidden" name="action" value="login">
        </form>
        <div class="notification is-danger is-light errorAjax" style="display: none;" id="error-notification">
        <!-- Mensaje de error aquí -->
    </div>
    </div>
</section>
