<?php
$action ='';
include './function.php';
if(!function_exists('save_category')):

function save_category($action) {
    echo json_encode(['status' => 'success', 'message' => 'Categoría guardada correctamente.', 'action' => $action]);
}

endif;

if(!function_exists('new_category')):

    function new_category($action) {
        ob_start();
         get_template_part('categoria', 'new');
        $html = ob_get_clean();
       echo json_encode([
            'status' => 'success',
            'message' => 'Nueva categoría creada correctamente.',
            'action' => $action,
            'html' => $html
        ]);
    }

endif;

if(!function_exists('cat_request_method')):

    function cat_request_method($action){
        switch($action) {
            case 'save_category':
                save_category($action);
                break;
            case 'new_category':
                new_category($action);
                break;
            default:
                echo json_encode(['status' => 'error', 'message' => 'Acción no reconocida.', 'action' => 'none']);
                break;
            // Add more cases as needed
        }
    }

endif;


if($_SERVER['REQUEST_METHOD'] === 'POST'){
   $action = $_POST['action'] ?? '';

    cat_request_method($action);

}

