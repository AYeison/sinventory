<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'):
        if(isset($_POST['action']) && $_POST['action'] === 'logout') {
            include dirname(__DIR__) . '/inc/session_start.php';
            session_start();
            user_session_out();
           
            echo json_encode([
                'status' => 'success',
                'message' => 'Sesión cerrada correctamente.'
            ]);
        } else {
          
             echo json_encode([
                'status' => 'error',
                'message' => 'Cierre de sesión no válido.'
             ]);
        }
endif;