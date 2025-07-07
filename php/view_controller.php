<?php
// File: php/view_controller.php
if(!function_exists('render_view')) {
    function render_view($view) {
     $file = dirname(__DIR__) . "/views/{$view}.php";
     $not_found = dirname(__DIR__) . "/views/404.php";

    
        if (file_exists($file) && isset($view)) {
        
            include $file;
           
        } else {
            http_response_code(404);
            
          include  $not_found;
        }
    }
}