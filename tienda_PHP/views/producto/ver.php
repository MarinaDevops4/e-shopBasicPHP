<?php if (isset($pro)) : ?>
    <h1><?= $pro->nombre ?></h1>

    <div id="detail-product">
        <div class="image">

            <?php if ($pro->imagen != null) : ?>
                <img src="<?= base_url ?>uploads/images/<?= $pro->imagen ?>" />
            <?php else : ?>
                <img src="../assets/img/logo2.jpg" />
            <?php endif; ?>
        </div>
        <div id="data">

            <h2><?= $pro->nombre ?></h2>

            <p  class="description"><?= $pro->descripcion ?></p>
            <p class="price"><?= $pro->precio ?>€</p>
            <a href="<?= base_url ?>carrito/add&id=<?=$pro->id?>" class="button">Comprar</a>
        </div>
    </div>




<?php else : ?>



    <h1>El producto no existe</h1>
<?php endif; ?>