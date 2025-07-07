<?php
is_user_logged_redirect();


if(is_user_logged_in()){
   ?>
  <section class="section">
    <div class="container">
        <h1 class="h1 title is-2 is-uppercase has-text-centered">
            Categorías

        </h1>
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
    <div class="content card-text">
   Esperando por una solicitud...
    </div>
  </div>
  <footer class="card-footer">
    <a href="#" class="card-footer-item">Save</a>
    <a href="#" class="card-footer-item">Edit</a>
    <a href="#" class="card-footer-item">Delete</a>
  </footer>
</div>


    </div>
    
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-6">
                <?php get_template_part('categoria', 'new'); ?>
            </div>
        </div>
  </section>
   <?php
} else {
    // El usuario NO está logueado
    echo "Por favor, inicia sesión.";
}