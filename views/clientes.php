<?php
is_user_logged_redirect();


if(is_user_logged_in()){
    // El usuario ya está logueado
    // Puedes redirigir o mostrar contenido especial
    echo "Bienvenido, usuario logueado.";

    ?>
       <div class="container " style="height:100vh;"></div>
    <?php
} else {
    // El usuario NO está logueado
    echo "Por favor, inicia sesión.";
}