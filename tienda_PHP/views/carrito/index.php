<h1>Carrito de la Compra</h1>
<?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) : ?>
    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Add</th>
            <th>Delete</th>

        </tr>
        <?php foreach ($carrito as $indice => $elemento) :
            $producto = $elemento['producto'];
        ?>

            <tr>

                <?php if ($producto->imagen != null) : ?>
                    <td><img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="img_carrito"> </td>
                <?php else : ?>
                    <td> <img src="<?= base_url ?>assets/img/logo2.jpg" class="img_carrito" /></td>
                <?php endif; ?>

                <td> <?= $producto->nombre ?></td>
                <td><?= $producto->precio ?></td>


                <td>

                    <a href="<?= base_url ?>carrito/up&index=<?= $indice ?>">
                        <img src="<?= base_url ?>assets/img/plus.png" class="btn-plus-min" alt="">
                    </a>

                    <?= $elemento['unidades'] ?>

                    <a href="<?= base_url ?>carrito/down&index=<?= $indice ?>">
                        <img src="<?= base_url ?>assets/img/less.png" class="btn-plus-min" alt="">
                    </a>

                </td>


                <td>
                    <a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>">
                        <img src="<?= base_url ?>assets/img/plus.png" class="btn-plus" alt="">
                    </a>
                </td>
                <td>
                    <a href="<?= base_url ?>carrito/delete_one&index=<?= $indice ?>">
                        <img src="<?= base_url ?>assets/img/trash.png" class="btn-plus" alt="">
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="<?= base_url ?>carrito/delete_all" class="button button-pedido button-red">Borrar Carrito</a>
    <div class="total-carrito">
        <?php $stats = Utils::statsCarrito() ?>
        <h3>Precio Total: <?= $stats['total']; ?>€</h3>
        <a href="<?= base_url ?>pedido/index" class="button button-pedido">Hacer Pedido</a>
    </div>

<?php else : ?>
    <h4>El carrito está vacío</h4>
   
<?php endif; ?>