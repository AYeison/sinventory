<?php
// File: php/view_controller.php
if(!function_exists('render_view')) {
    function render_view() {
$url = isset($_GET['url']) ? $_GET['url'] : 'home';
$url = rtrim($url, '/');
$routes = [
    // Obtener todas las vistas .php en la carpeta views
    ...array_reduce(
        glob('views/*.php'),
        function($carry, $file) {
            $key = basename($file, '.php');
            $carry[$key] = $file;
            return $carry;
        },
        []
    ),
    // Agrega más rutas según tus vistas
];

if (array_key_exists($url, $routes)) {
    require $routes[$url];
} else {
    require 'views/404.php';
}
    }
}