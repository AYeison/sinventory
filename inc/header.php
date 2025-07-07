<?php 

include dirname(__DIR__) . '/php/view_controller.php'; 
include dirname(__DIR__) . '/inc/session_start.php';

session_start();

session_regenerate_id(true);
is_user_logged_redirect();

?>

<header class="header container">
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="?view=home">
                <img src="./public/assets/img/logo.svg" alt="Logo">
            </a>
            <button class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </button>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="?view=home">Inicio</a>
                <a class="navbar-item" href="?view=productos">Productos</a>
                <a class="navbar-item" href="?view=clientes">Clientes</a>
                <a class="navbar-item" href="?view=categorias">Categorías</a>
            </div>

            <div class="navbar-end">
                <?php if(!is_user_logged_in()):?>
         <div class="navbar-item">
                    <div class="field is-grouped">
                        <p class="control">
                            <a class="button is-primary" href="?view=login">
                                <span class="icon">
                                    <i class="fas fa-user"></i>
                                </span>
                                <span>Iniciar Sesión</span>
                            </a>
                        </p>
                    </div>
                </div>
                  <div class="navbar-item">
                    <div class="field is-grouped">
                        <p class="control">
                            <a class="button is-primary" href="?view=register">
                                <span class="icon">
                                    <i class="fas fa-user"></i>
                                </span>
                                <span>Registrar</span>
                            </a>
                        </p>
                    </div>
                </div>  

                <?php else: ?>


               <div class="navbar-item">
                    <div class="field is-grouped">
                        <p class="control">
                           <form method="POST" action="./php/logout.php" class="ajaxform">
                               <input type="hidden" name="action" value="logout">
                               <button class="button is-primary" type="submit">
                                   <span class="icon">
                                       <i class="fas fa-sign-out-alt"></i>
                                   </span>
                                   <span>Salir</span>
                               </button>
                           </form>
                        </p>
                    </div>
                </div>  

                    <?php endif; ?>
                  
            </div>
        </div>
    </nav>
</header>
