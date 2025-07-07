<?php
is_user_logged_redirect();
global $view;

if(is_user_logged_in()):

   
?>
<section class="section">
    <div class="container">
        <h1 class="title is-2 is-uppercase"><?php echo $view; ?></h1>

    </div>
</section>
   <div class="container " style="height:100vh;"></div>
<?php
else:
// El usuario NO está logueado
    echo "Por favor, inicia sesión.";
endif; 

 