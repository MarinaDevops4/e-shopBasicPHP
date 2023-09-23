<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Master</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div id="container">
        <!-- CABECERA -->
        <header id="header">
            <div id="logo" class="logo">
                <img src="assets/img/logo.png" alt="Camiseta Logo">
                <a href="index.php">Tienda Tablas Snowboard
                </a>
            </div>
        </header>
        <!-- MENU -->
        <nav id="menu">
            <ul>
                <li>
                    <a href="#">Inicio</a>
                </li>
                <li>
                    <a href="#">Categoria 1</a>
                </li>
                <li>
                    <a href="#">Categoria 2</a>
                </li>
                <li>
                    <a href="#">Categoria 3</a>
                </li>
                <li>
                    <a href="#">Categoria 4</a>
                </li>
            </ul>
        </nav>
        <div id="content">
            <!-- BARRA LATERAL -->
            <aside id="lateral">
                <div id="login" class="block_aside">
                    <h3>Entrar a la Web</h3>
                    <form action="#" method="post">
                        <label for="emal">Email</label>
                        <input type="email" name="email" id="email">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password">
                        <input type="submit" value="Enviar">
                    </form>
                    <ul>
                        <li><a href="#"> Mis pedidos</a></li>
                        <li> <a href="#"> Gestionar pedidos</a></li>
                        <li><a href="#"> Gestionar categorias</a></li>
                    </ul>



                </div>
            </aside>
            <!-- CONTENIDO CENTRAL  -->
            <div id="central">
                <h1>Productos Destacados</h1>
                <div class="product">
                    <img src="assets/img/tabla1.png" alt="tabla">
                    <h2>Tabla de Diseño</h2>
                    <h4>Principiantes</h4>
                    <p>200€</p>
                    <a href="#" class="button">Comprar</a>
                </div>
                <div class="product">
                    <img src="assets/img/tabla2.png" alt="tabla">
                    <h2>Tabla de Diseño</h2>
                    <h4>Principiantes</h4>
                    <p>200€</p>
                    <a href="#" class="button">Comprar</a>
                </div>
                <div class="product">
                    <img src="assets/img/tabla1.png" alt="tabla">
                    <h2>Tabla de Diseño</h2>
                    <h4>Principiantes</h4>
                    <p>200€</p>
                    <a href="#" class="button">Comprar</a>
                </div>
                <div class="product">
                    <img src="assets/img/tabla2.png" alt="tabla">
                    <h2>Tabla de Diseño</h2>
                    <h4>Principiantes</h4>
                    <p>200€</p>
                    <a href="#" class="button">Comprar</a>
                </div>
            </div>
        </div>
        <!-- PIE DE PAGINA -->
        <footer id="footer">
            <p>Desarrollado por Marina Barceló Web&copy</p><?php date('y') ?>
        </footer>
    </div>
</body>

</html>