<?php
include dirname(__DIR__) . '/db/db.php';
include dirname(__DIR__) . '/inc/regex.php';
include dirname(__DIR__) . '/inc/session_start.php';

if(!function_exists('login_user')):
                function login_user($username, $password) {
                    $username = clean_text($username);
                    $password = clean_text($password);
                    $conn = connect_db();
                    $errors = [];
                    if (!$conn) {
                        echo json_encode(['status'=> 'error', 'message' => 'Error de conexión a la base de datos']);
                        exit();
                    }

                    try{
                    $stmt = $conn->prepare("SELECT usuario_name, usuario_password FROM usuarios WHERE usuario_name = :usuario_name OR usuario_email = :usuario_name");
                    $stmt->execute([':usuario_name' => $username, ':usuario_email' => $username]);
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                    $user_password = $user['usuario_password'] ?? '';
                    $user_name = $user['usuario_name'] ?? '';
                     $input_data = [
                                'username_or_email' => [
                                    'value' => $username,
                                    'regex' => get_regex_patterns('username_or_email'),
                                    'error_msg' => 'Nombre de usuario o correo electrónico inválido.',
                                ],
                                'password' => [
                                    'value' => $password,
                                    'regex' => get_regex_patterns('password'),
                                    'error_msg' => 'Contraseña inválida.',
                                ],
                            ];

                            $errors = verify_regex_text($input_data);

                            if(empty($errors)){
                                if(password_verify($password, $user_password)) {
                                               $user_id = get_user_id($conn, $username);
                                               if ($user_id) {
                                                   user_session_start($user_id, $user_name);
                                                   echo json_encode(['status' => 'success', 'message' => 'Inicio de sesión exitoso']);
                                               } else {
                                                   echo json_encode(['status' => 'error', 'message' => 'Usuario no encontrado']);
                                               }
                                           } else {
                                               echo json_encode(['status' => 'error', 'message' => 'Credenciales incorrectas']);
                                           }

                            }else{
                                echo json_encode([
                                       'status' => 'error',
                                       'message' => implode(' ', $errors)
                                   ]);
                            }

           
                }catch(PDOException $e){
                       die("Error fetching user ID: " . $e->getMessage());
                }
                  
                }
endif;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $action = $_POST['action'] ?? '';
    if ($action === 'login') {
        login_user($_POST['username'], $_POST['password']);
    } else {
        echo 'Acción no válida.';
    }
}