<?php
 include dirname(__DIR__) . '/inc/get_user_info.php';


function user_session_start($user_id = null, $user_name = null, $user_ip = null, $user_agent = null) {
     session_set_cookie_params([
        'lifetime' => 86400,
        'path' =>  '/',
        'domain' => $_SERVER['HTTP_HOST'] ?? '',
        'httponly' => true,
        'samesite' => 'Strict',
        'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? true : false
    ]);
   
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
   
    session_regenerate_id(true);

    $_SESSION['user_id'] =  $user_id ?? null;
    $_SESSION['user_name'] = $user_name ?? null;
    $_SESSION['user_ip'] = $user_ip ?? null;
    $_SESSION['user_agent'] = $user_agent ?? null;

  
}
function is_session_valid() {
    if (!isset($_SESSION['user_agent']) || !isset($_SESSION['user_ip'])) {
        return false;
    }
    if ($_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
        return false;
    }
    if ($_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR']) {
        return false;
    }
    return true;
}

function is_user_logged_in(){
    if(is_session_valid() && isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
        return true;
    }
}


function is_user_logged_redirect(){
  global  $view, $root;
    if(is_user_logged_in() && ($view === 'login' || $view === 'register')){
      header("Location: $SERVER_NAME/$root/home");
         exit();
    }else if(!is_user_logged_in() && $view != 'register' && $view != 'home' && $view != 'login' && $view != '404'){
        header("Location: $SERVER_NAME/$root/login");
        exit();
    }
}


function user_session_out(){
    if (session_status() === PHP_SESSION_ACTIVE) {
        $_SESSION = array();
        session_unset();
        session_destroy();

          if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
    }
}
