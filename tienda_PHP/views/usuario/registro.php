<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Registrarse</h1>
    <?php if (isset($_SESSION['registro']) && $_SESSION['registro']  == 'complete' ): ?>
        <strong class="alert_green">Registro completado correctamente</strong>
    <?php elseif(isset($_SESSION['registro']) && $_SESSION['registro']  == 'failed' ) : ?>
        <strong class="alert_red">Registro Fallido, introduce bien los datos</strong>
    <?php endif; ?>


    <?php Utils::deleteSession('registro');?>

    <form action="<?= base_url ?>usuario/save" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos" >
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <input type="submit" value="Registrarse">
    </form>
</body>

</html>