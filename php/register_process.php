<?php

include dirname(__DIR__) . '/inc/regex.php';
include dirname(__DIR__) . '/db/db.php';

function register_user($username, $email, $password) {

    $username = clean_text($username);
    $email = clean_text($email);
    $password = clean_text($password);

    $errors = [];

    $input_data = [
        'username' => [
            'value' => $username,
            'regex' => get_regex_patterns('username'),
            'error_msg' => 'Nombre de usuario inválido.',
        ],
        'email' => [
            'value' => $email,
            'regex' => get_regex_patterns('email'),
            'error_msg' => 'Correo electrónico inválido.',
        ],
        'password' => [
            'value' => $password,
            'regex' => get_regex_patterns('password'),
            'error_msg' => 'Contraseña inválida.',
        ],
    ];

   $errors = verify_regex_text($input_data);
    

    if (empty($errors)) {
        $db = connect_db();
      
            if(verify_same_user($db, $username, $email)){
                echo json_encode([
                    'status' => 'error',
                    'message' => 'El usuario ya existe.'
                ]);
                $db = disconnect_db($db);
                exit();
            }

                if(create_new_user($db, $username,$email,$password) === true){
                        echo json_encode([
                    'status' => 'success',
                    'message' => 'Usuario registrado correctamente.'
                ]);

        $db = disconnect_db($db);
         exit();
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Error al registrar el usuario. Por favor, inténtelo de nuevo más tarde.'
            ]);

        }
      
    } else {

       echo json_encode([
            'status' => 'error',
            'message' => implode(' ', $errors)
        ]);
    }

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'register') {
        register_user($_POST['username'], $_POST['email'], $_POST['password']);
    } else {
        echo 'Acción no válida.';
    }
} else {
    echo 'Método no permitido.';
}