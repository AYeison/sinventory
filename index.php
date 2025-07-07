<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="stylesheet" href="./public/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Sistema de Inventario</title>
</head>
<body>

<?php $view = $_GET['view'] ?? 'home'; ?>
        <?php include './inc/header.php'; ?>        
      <main class="main" style="height: 100vh;">
        <?php render_view($view); ?>
      </main>

        <?php include './inc/footer.php'; ?>
  
</body>
</html>