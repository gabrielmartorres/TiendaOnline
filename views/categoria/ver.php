<?php if (isset($subCategoria) && isset($categoria) && isset($mostrarSubcategoria)) : ?>
    <!--Muestro los productos de la categoría-->
    <?php if ($mostrarSubcategoria == false): ?>
        <h1><?= $categoria->nombre ?></h1>
        <?php if ($productos->num_rows == 0): ?>
            <p>No hay productos para mostrar</p>
        <?php else: ?>

            <?php while ($product = $productos->fetch_object()): ?>
                <div class="product">
                    <a href="<?= base_url ?>producto/ver&id=<?= $product->id ?>">
                        <?php if ($product->imagen != null): ?>
                            <img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" />
                        <?php else: ?>
                            <img src="<?= base_url ?>assets/img/camiseta.png" />
                        <?php endif; ?>
                        <h2><?= $product->nombre ?></h2>
                    </a>
                    <p><?= $product->precio ?></p>
                    <a href="<?= base_url ?>carrito/add&id=<?= $product->id ?>" class="button">Comprar</a>
                </div>
            <?php endwhile; ?>
            <div id="paginacion">
                <?php $pagination->render(); ?>
            </div>            
        <?php endif; ?>
    <!--Muestro las subcategorías-->        
    <?php else: ?>  
        <h1>Tipos de <?= $categoria->nombre ?></h1>

        <?php if ($subCategorias->num_rows == 0): ?>
            <p>No hay tipos de <?= $categoria->nombre ?> para mostrar</p>
        <?php else: ?>

            <?php while ($subCategoria = $subCategorias->fetch_object()): ?>
                <div class="product">
                    <a href="<?= base_url ?>subcategoria/ver&id=<?= $subCategoria->id ?>">
                        <?php if ($subCategoria->imagen != null): ?>
                            <img src="<?= base_url ?>uploads/images/<?= $subCategoria->imagen ?>" />
                        <?php else: ?>
                            <img src="<?= base_url ?>assets/img/tipos-de-telas.jpg" />
                        <?php endif; ?>                     
                        <h2><?= $subCategoria->nombre ?></h2>
                    </a>
                    <a href="<?= base_url ?>subcategoria/ver&id=<?= $subCategoria->id ?>" class="button">Ver</a>
                </div>
            <?php endwhile; ?>

        <?php endif; ?>
    <?php endif; ?>  
<?php else: ?>
    <h1>La categoría no existe</h1>
<?php endif; ?>
