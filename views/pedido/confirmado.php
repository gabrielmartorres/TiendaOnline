<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'): ?>
    <?php if ($save == false && isset($_SESSION['carrito'])): ?>
        <h1>Tu pedido no se puede procesar</h1>
        <p>
            Lo sentimos, pero alguno de los productos que has seleccionado no dispone de stock. <br><br>Por favor, revisa tu <a href="<?= base_url ?>carrito/index">Carrito</a> y vuelve a intentarlo.
        </p>
        <?php elseif($save == false && !isset($_SESSION['carrito'])): ?>
            <h1>No tienes pedidos</h1>
    <?php else: ?>
        <h1>Tu pedido se ha confirmado</h1>
        <p>
            Tu pedido ha sido guardado con éxito, una vez que realices la transferencia 
            bancaria a la cuenta 7382947289239ADDS con el coste del pedido, será procesado y enviado.
        </p>
        <br>
        <?php if (isset($pedido)): ?>
            <h3>Datos del pedido:</h3>

            Número de pedido: <?= $pedido->id ?><br>
            Total a pagar: <?= $pedido->coste ?> €<br>
            Productos: 
            <table>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                </tr>
                <?php while ($producto = $productos->fetch_object()): ?>
                    <tr>
                        <td>
                            <?php if ($producto->imagen != null): ?>
                                <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="img-carrito" />
                            <?php else: ?>
                                <img src="<?= base_url ?>assets/img/camiseta.png" class="img-carrito"/>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
                        </td>
                        <td>
                            <?= $producto->precio ?>
                        </td>
                        <td>
                            <?= $producto->unidades ?>
                        </td>
                    </tr>   
                <?php endwhile; ?>
            </table>
            <?php
            unset($_SESSION['pedido']);
            unset($_SESSION['carrito']);
            ?>
        <?php endif; ?>
    <?php endif; ?>


<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete'): ?>
    <h1>Tu pedido NO ha podido procesarse.</h1>
<?php elseif (!isset($_SESSION['pedido']) && !isset($_SESSION['carrito'])): ?>
    <h1>No tienes pedidos</h1>
<?php endif; ?>

