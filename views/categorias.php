<?php
is_user_logged_redirect();


if(is_user_logged_in()){
   ?>
   <div id="cat_noty_message"></div>
   <section class="section">
      <h1 class="h1 title is-2 is-uppercase has-text-centered">
            Categorías

        </h1>
    <div class="container">
       <?php
    get_template_part('categoria', 'read');
    ?>
    </div>

   </section>
  <section class="section">
    <div class="container">
      
        <div class="card">
  <header class="card-header">
    <p class="card-header-title">Gestor de Categorias</p>
    <button class="card-header-icon card-down-toggle" aria-label="more options">
      <span class="icon card-down-toggle">
        <i class="fas fa-angle-down card-down-toggle" aria-hidden="true"></i>
      </span>
    </button>
  </header>
  <div class="card-content">
    <div class="content card-text" id="cat_message" data-type="waiting" data-st-message="Esperando por una solicitud...">
   Esperando por una solicitud...
    </div>
  </div>
  <footer class="card-footer">
      <form action="./php/category.php" method="POST" class="ajaxform card-footer-item">
        <input type="hidden" name="action" value="new_category">
        <button type="submit" value="Nueva Categoría" class="button card-footer-item  cursor-pointer has-text-link-light	has-background-inherit is-size-6" style="cursor: pointer;border:none;" data-type="new_category">
          Nueva Categoría
        </button>
      </form>
     <button type="submit" class="card-footer-item has-text-link-light" id="edit-category" data-mode="active-dlt">Edit</button>
    <button type="submit" class="card-footer-item has-text-link-light" id="delete-category" data-mode="active-dlt">Delete</button>
  </footer>
</div>


    </div>
    
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-6">
              
            </div>
        </div>
  </section>
   <?php
} else {
    // El usuario NO está logueado
    echo "Por favor, inicia sesión.";
}