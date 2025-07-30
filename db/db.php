<?php

include dirname(__DIR__) . '/inc/get_user_info.php';
//DB connection


if(!function_exists('connect_db')){
    function connect_db() {
        $host = 'mysql:host=localhost;dbname=inventory';
        $user = 'root';
        $password = '';
        try {
            $conn = new PDO($host, $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
        return null;
    }
}
if(!function_exists('create_new_user')):
        function create_new_user($conn, $username, $email, $password) {
            try {
                $stmt = $conn->prepare("INSERT INTO usuarios (usuario_name, usuario_email, usuario_password, usuario_ip, user_agent) VALUES (:usuario_name, :usuario_email, :usuario_password, :usuario_ip, :user_agent)");
                $stmt->execute([
                    ':usuario_name' => $username,
                    ':usuario_email' => $email,
                    ':usuario_password' => password_hash($password, PASSWORD_BCRYPT),
                    ':usuario_ip' => get_user_ip(),
                    ':user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'UNKNOWN'
                ]);

                return true;
              
            } catch (PDOException $e) {
                die("Error creating user: " . $e->getMessage());
            }

        }
endif;
if(!function_exists('verify_same_user')){
    function verify_same_user($conn, $username, $email) {
        try {
          $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario_name = :usuario_name OR usuario_email = :usuario_email");
            $stmt->execute([
                ':usuario_name' => $username,
                ':usuario_email' => $email
            ]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
           
            if ($user) {
    
            return true;
            }
            return false;
         
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }
}

if(!function_exists('disconnect_db')){
    function disconnect_db($conn) {
        $conn = null;
        return $conn;
    }
}

if(!function_exists('get_user_id')):
                function get_user_id($conn, $username) {
                    try {
                        $stmt = $conn->prepare("SELECT usuario_id FROM usuarios WHERE usuario_name = :usuario_name OR usuario_email = :usuario_name");
                        $stmt->execute([':usuario_name' => $username, ':usuario_email' => $username]);
                        $user = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if ($user) {
                            return $user['usuario_id'];
                        }
                        return null;
                    } catch (PDOException $e) {
                        die("Error fetching user ID: " . $e->getMessage());
                    }

                }
endif;

if(!function_exists('save_user_ip')):
            function save_user_ip($conn, $user_id, $ip_address) {
                try {
                    $stmt = $conn->prepare("INSERT INTO user_ips (usuario_id, ip_address) VALUES (:usuario_id, :ip_address)");
                    $stmt->execute([
                        ':usuario_id' => $user_id,
                        ':ip_address' => $ip_address
                    ]);
                    return true;
                } catch (PDOException $e) {
                    die("Error saving user IP: " . $e->getMessage());
                }
            }
        endif;


if(!function_exists('create_category')):
            function create_category($conn, $name, $description, $slug){
                try{
                    $stmt = $conn->prepare("INSERT INTO categorias (categoria_name, categoria_description, categoria_slug) VALUES (:nombre, :descripcion, :slug)");
                    $stmt->execute([
                        ':nombre' => $name,
                        ':descripcion' => $description,
                        ':slug' => $slug
                    ]);
                    return [
                        'success' => true,
                        'id' => $conn->lastInsertId(),
                    ];
                } catch (PDOException $e) {
                    die("Error creating category: " . $e->getMessage());
                }
            }
endif;

if(!function_exists('get_categories')):
        function get_categories($conn){
            try {
                $stmt = $conn->prepare("SELECT * FROM categorias");
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Error fetching categories: " . $e->getMessage());
            }
        }
endif;

if(!function_exists('db_delete_category')):
            function db_delete_category($conn,  int $category_id) {
                try {
                    $stmt = $conn->prepare("DELETE FROM categorias WHERE categoria_id = :categoria_id");
                    $stmt->execute([':categoria_id' => $category_id]);
                    return true;
                } catch (PDOException $e) {
                    die("Error deleting category: " . $e->getMessage());
                }
            }
endif;