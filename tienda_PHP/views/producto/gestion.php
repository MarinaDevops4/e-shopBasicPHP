
<h1>Gestion de Productos</h1>
<!-- CREAR PRODUCTO -->
<a href="<?= base_url ?>producto/crear" class="button button-small">Crear Producto</a>
<?php if (isset($_SESSION['producto']) && $_SESSION['producto'] == true) : ?>
    <strong class="alert_green">El producto ha sido guardado correctamente</strong>
<?php elseif (isset($_SESSION['producto']) && $_SESSION['producto'] == false) : ?>
    <strong class="alert_red">ERROR: El producto no ha sido guardado correctamente</strong>
<?php endif; ?>

<?php Utils::deleteSession('producto'); ?>
<!-- ELIMINAR PRODUCTO  -->
<?php if (isset($_SESSION['eliminar']) && $_SESSION['eliminar'] == true) : ?>
    <strong class="alert_green">El producto ha sido eliminado correctamente</strong>
<?php elseif (isset($_SESSION['eliminar']) && $_SESSION['eliminar'] == false) : ?>
    <strong class="alert_red">ERROR: El producto no ha sido eliminado correctamente</strong>
<?php endif; ?>

<?php Utils::deleteSession('eliminar'); ?>

<table class="productos">
    <tr>
      
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Acciones</th>
        <!-- <th>Actualizar</th> -->

    
    </tr>
    <?php while ($pro = $productos->fetch_object()) : ?>
        <tr>
        
            
            <td><?= $pro->nombre ?></td>
            <td><?= $pro->descripcion ?></td>
            <td><?= $pro->precio ?></td>
            <td><?= $pro->stock ?></td>
            <td>
                <a href="<?=base_url?>producto/editar&id=<?=$pro->id?>" class="button button-gestion ">
                Editar
                <a href="<?=base_url?>producto/eliminar&id=<?=$pro->id?>"  class="button button-gestion button-red ">
                   Eliminar
                </a>
            </a>
            
        
            </td>
          
            
        </tr>
    <?php endwhile; ?>
</table>
