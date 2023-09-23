<?php if (isset($edit) && isset($pro) && is_object($pro)): ?>
    <h1>Editar Produt <?=$pro->nombre?></h1>
    <?php $url_action = base_url."producto/save&id=".$pro->id ?>
<?php else : ?>
    <h1>Crear Nuevo Produto</h1>
    <?php $url_action = base_url."producto/save" ?>
<?php endif; ?>

<form action="<?= $url_action ?>" method="post" enctype="multipart/form-data">
    <label for="nombre_producto">Nombre Producto</label>
    <input type="text" name="nombre" id="nombre" value="<?= isset($pro) && is_object($pro)? $pro->nombre : ''; ?>" required>
    <label for="descripcion_producto">Descripcion Producto</label>
    <textarea name="descripcion" id="descripcion" >
    <?= isset($pro) && is_object($pro)? $pro->descripcion : '' ?>
    </textarea>
    <label for="precio">Precio</label>
    <input type="text" name="precio" id="precio" value="<?= isset($pro) && is_object($pro)? $pro->precio : ''; ?>" required>
    <label for="stock">Stock Producto</label>
    <input type="number" name="stock" id="stock" value="<?= isset($pro) && is_object($pro)? $pro->stock : ''; ?>">
    <label for="categoria">Categoria</label>

    <?php $categorias = Utils::showCategorias(); ?>

    <select name="categoria" id="">

        <?php while ($cat = $categorias->fetch_object()) : ?>
            <option value="<?= $cat->id ?>" <?= isset($pro) && $cat->id == $pro->categoria_id && is_object($pro)? 'selected' : '' ?>>
            <?= $cat->nombre ?>
        </option>
        <?php endwhile; ?>

    </select>
    <label for="imagen">Imagen Producto</label>
    <?php if( isset($pro) && is_object($pro) && !empty($pro->imagen)) :  ?>
        <img src="<?=base_url?>uploads/images/<?=$pro->imagen?>" class="thumb"/>
        <?php endif;?>
    <input type="file" name="imagen" id="imagen">


    <input type="submit" value="Guardar">
</form>