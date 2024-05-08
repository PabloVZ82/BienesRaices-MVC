<?php

if (!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['login'] ?? false;

if (!isset($inicio)) {
    $inicio = false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="../build/css/app.css">

</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <!-- tuve q modificar el href para q coincidan las rutas -->
                    <img src="/build/img/logo.svg" alt="logotipo de bienes raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg">
                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contactos</a>
                        <?php if ($auth) : ?>
                            <a href="/logout">Cerrar sesion</a>
                        <?php endif; ?>

                    </nav>
                </div>

            </div> <!--.barra-->

            <?php if ($inicio) { ?> <!-- Le agrego isset prq tirar error de declaracion de $inicio -->
                <h1>Venta de casas y Departamentos Exclusivos de Lujo</h1>
            <?php }  ?>
        </div>
    </header>

    <?php echo $contenido; ?>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer"></div>
        <nav class="navegacion">
            <a href="/nosotros">Nosotros</a>
            <a href="/propiedades">Anuncios</a>
            <a href="/blog">Blog</a>
            <a href="/contacto">Contactos</a>
            
            <?php if ($inicio) { ?> <!-- prueba de login inicio -->

                <a href="/login">Login</a>
                <a href="/admin">Admin</a>
            <?php }  ?>
        </nav>
        <p class="copyright">Todos los derechos reservados <?php echo date('Y'); ?> &copy;</p>
    </footer>

    <script src="../build/js/bundle.min.js"></script>
    <!-- <script src="build/js/bundle.min.js"></script> -->
</body>

</html>