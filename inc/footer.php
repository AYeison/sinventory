<?php
include_once './scripts/navbar.php';
 global $view;
 ?>

 <footer class="footer ">
   <div class="container">
      <div class="content has-text-centered">
         <p>
             <strong>Sistema de Inventario</strong> by <a href="#">FityFour</a>
         </p>
     </div>
   </div>
 </footer>
<?php if($view === 'categorias' || $view === 'login' || $view === 'register') : ?>
   <script src="./public/js/ajaxforms.js"></script>
     <script src="./public/js/dist/app_cat.bundle.js"></script>
<?php endif; ?>