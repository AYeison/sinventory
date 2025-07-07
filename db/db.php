<?php

include dirname(__DIR__) . '/inc/get_user_info.php';
//DB connection
$host = 'mysql:host=localhost;';
$user = 'root';
$password = '';
$database = 'dbname=inventory';

if(!function_exists('connect_db')){
    function connect_db() {
        global $host, $user, $password, $database;
        try {
            $conn = new PDO($host . $database, $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            return $conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
        return $conn;
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