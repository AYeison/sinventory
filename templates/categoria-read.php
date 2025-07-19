<?php
// Ejemplo de categorías
include dirname(__DIR__) . '/db/db.php';
$conn = connect_db();
$categories = get_categories( $conn );

?>

<div class="columns is-multiline is-variable is-4" style="margin-top: 30px;" id="categories-list">
    <?php foreach ($categories as $cat): ?>
        <div class="column is-one-quarter" id="category-<?php echo $cat['categoria_id'] ?>" style="position:relative;">
            <div class="card">
                <div class="card-content">
                    <p class="title is-5"><?php echo htmlspecialchars($cat['categoria_name'])?></p>
                    <p class="subtitle is-6"><?php echo htmlspecialchars($cat['categoria_description'])?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<?php
disconnect_db($conn);
?>