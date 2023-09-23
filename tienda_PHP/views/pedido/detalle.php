<h1>Detalle del Pedido</h1>


<?php if (isset($pedido)) : ?>
<?php if (isset($_SESSION['admin'])) : ?>
    
    <h3>Cambiar Estado:</h3>
    <form action="<?=base_url?>pedido/estado" method="post">
    <input type="hidden" value="<?=$pedido->id?>"  name="pedido_id">
        <select name="estado" id="">
            <option value="confirm" <?=$pedido->estado == 'confirm' ? 'selected' : ''?>>Pendiente</option>
            <option value="preparation" <?=$pedido->estado == 'preparation' ? 'selected' : ''?>>En preparacion</option>
            <option value="ready" <?=$pedido->estado == 'ready' ? 'selected' : ''?>>Preparado para enviar</option>
            <option value="sended" <?=$pedido->estado == 'sended' ? 'selected' : ''?>>Enviado</option>
        </select>
        <input type="submit" value="Cambiar Estado">

    </form>
    <br>
    <?php endif ; ?>


    <h3>Datos del pedido:</h3>
    <table>

        <tr>
            <th>Localidad</th>
            <th>Provincia </th>
            <th>Direccion </th>

        </tr>
        <tr>
            <td> <?= $pedido->localidad ?></td>

            <td><?= $pedido->provincia ?></td>
            <td><?= $pedido->direccion ?></td>
        </tr>
        <tr>
            <th>Estado </th>
            <th>Nombre Pedido </th>
            <th>Total a pagar </th>
            <!-- <th>Productos Datos </th> -->

        </tr>
        <tr>
            <td><?= Utils::showEstado($pedido->estado) ?></td>
            <td><?= $pedido->id ?></td>
            <td> <?= $pedido->coste ?> </td>
         
        </tr>
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

       
        
    </table>

<?php endif; ?>