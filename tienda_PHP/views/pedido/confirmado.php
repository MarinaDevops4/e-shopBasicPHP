<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == true) : ?>
    <h1>Tu pedido ha sido confirmado</h1>
    <p>Tu pedido ha sido guardado con existo, una vez realices la transferencia bancaria con el coste del pedido,
        será procesado y enviado.

    </p>
    <br>

    <?php if (isset($pedido)) : ?>
        <h3>Datos del pedido:</h3>
        <table>
            <tr>
                <th>Nombre Pedido </th>
                <th>Total a pagar </th>
                <th>Productos Datos </th>

            </tr>
            <tr>
                <td><?= $pedido->id ?></td>
                <td> <?= $pedido->coste ?> </td>

                <td>

                 <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                    <th>Add</th>

                </tr>
            <?php while ($producto = $productos->fetch_object()) : ?>
                <tr>

                    <?php if ($producto->imagen != null) : ?>
                        <td><img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="img_carrito"> </td>
                    <?php else : ?>
                        <td> <img src="<?= base_url ?>assets/img/logo2.jpg" class="img_carrito" /></td>
                    <?php endif; ?>

                    <td> <?= $producto->nombre ?></td>

                    <td><?= $producto->precio ?></td>
                    <td><?= $producto->unidades ?></td>
                    <td>
                        <a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>">
                            <img src="<?= base_url ?>assets/img/plus.png" class="btn-plus" alt="">
                        </a>
                    </td>
                </tr>


            <?php endwhile; ?>

            </td>
            </tr>
        </table>

    <?php endif; ?>

<?php else : ?>
    <h1>Tu pedido no se ha realizado </h1>
    <p>Tu pedido no ha podido guardarse con existo.
    </p>

<?php endif; ?>