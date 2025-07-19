<?php
$action ='';
include '../db/db.php';
include './function.php';
include '../inc/regex.php';
if(!function_exists('save_category')):

function save_category($action) {
    $cat_name = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $cat_description = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
    $cat_slug = isset($_POST['slug']) ? $_POST['slug'] : null;
    $input_data = [
        'cat_name' => [
            'value' => $cat_name,
            'regex' => get_regex_patterns('onlyspaces'),
            'error_msg' => 'Nombre de categoría inválido.',
        ],
        'cat_description' => [
            'value' => $cat_description,
            'regex' => get_regex_patterns('onlyspaces'),
            'error_msg' => 'Descripción de categoría inválida.',
        ],
        'cat_slug' => [
            'value' => $cat_slug,
            'regex' => get_regex_patterns('alfanum_guion'),
            'error_msg' => 'Slug de categoría inválido.',
        ],
    ];

    $errors = verify_regex_text($input_data);

    if (empty($errors)) {
        $conn = connect_db();
        if ($conn && $cat_name && $cat_description && $cat_slug) {
            $create_category = create_category($conn, $cat_name, $cat_description, $cat_slug);
            $cat_success = $create_category['success'] ?? false;
            if ($cat_success) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Categoría creada correctamente.',
                    'action' => $action,
                    'last_category' => [
                        'categoria_name' => $cat_name,
                    'categoria_description' => $cat_description,
                    'categoria_slug' => $cat_slug,
                    'categoria_id' => $create_category['id'] ?? null,
                    ]
                   
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al crear la categoría.']);
            }
            disconnect_db($conn);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error de conexión a la base de datos.']);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => implode(' ', $errors)
        ]);
    }
    
  
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
            'html' => $html,
            
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

