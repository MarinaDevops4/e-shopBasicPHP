<h1>Gestionar Categorias</h1>
 
<?php if(isset($_SESSION['existeCategoria']) && $_SESSION['existeCategoria'] == true ): ?>
<strong class="alert_red">El dato ya existe en la base de datos.</strong>

<?php elseif(isset($_SESSION['existeCategoria']) && $_SESSION['existeCategoria'] == false ) : ?>
    <strong class="alert_green">El dato se ha guardado correctamente en la base de datos.</strong>
<?php endif;?>
<?php Utils::deleteSession('existeCategoria');?>
<a href="<?=base_url?>categoria/crear"  class="button button-small">Crear Categoría</a>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
    </tr>
    <?php while ($cat = $categorias->fetch_object()) : ?>
        <tr>
            <td><?= $cat->id ?></td>
            <td><?= $cat->nombre ?></td>
        </tr>
    <?php endwhile; ?>
    </table>