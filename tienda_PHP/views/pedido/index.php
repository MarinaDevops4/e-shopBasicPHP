<?php if (isset($_SESSION['identity'])) : ?>

    <h1>Realizar Pedido</h1>
    <p>
        <a href="<?= base_url ?>carrito/index">Ver los productos y precio del pedido</a>
    </p>
    <br>
    <h3>Direccion para Envio</h3>
    <form action="<?=base_url.'pedido/add'?>" method="post">
        <label for="provincia">Provincia:</label>
        <input type="text" name="provincia" required>

        <label for="localidad">Localidad:</label>
        <input type="text" name="localidad" required>

        <label for="direccion">Direccion:</label>
        <input type="text" name="direccion" required>
        
        <input type="submit" value="Confirmar Pedido">
    </form>



<?php else : ?>
    <h1>Necesitas estar identidicado.</h1>
    <p>Necesitas estar logueado en la web para realizar tu pedido.</p>
<?php endif; ?>