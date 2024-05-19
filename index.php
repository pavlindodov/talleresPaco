<?php
    include_once ('estructuraPublica.php');
    session_start();
    $ruta = "";
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="back/img/imgPagina/logotipo.png">
        <link href=css/main.css type=text/css rel=stylesheet>
        <link href=css/nav.css type=text/css rel=stylesheet>
        <link href=css/index.css type=text/css rel=stylesheet>
        <link href=css/background.css type=text/css rel=stylesheet>
        <link href=css/content.css type=text/css rel=stylesheet>
        <link href=css/footer.css type=text/css rel=stylesheet>
        <title>Inicio</title>
    </head>
    <body>
        <header>
            <?php
                nav($ruta);
            ?>
        </header>
        <div class=content>
            <?php
                echo "<div class='comments'>";
                    if (isset($_GET['registerSuccess']))
                        if ($_GET['registerSuccess'] == 1)
                            echo "<p style='color:green'>Usted se ha registrado correctamente.</p>";

                    if (isset($_GET['loginSuccess']))
                        if ($_GET['loginSuccess'] == 1)
                            echo "<p style='color:green'>Usted ha iniciado sesión correctamente.</p>";

                    if (isset($_GET['loginError']))
                        if ($_GET['loginError'] == 1)
                            echo "<p style='color:red'>Usted no ha iniciado sesión.</p>";
                echo "</div>";
            ?>
        </div>
        <div class="banner">
            <h2>Reparación Profesional de Vehículos</h2>
            <p>Confía en nuestro equipo de expertos para cuidar de tu automóvil</p>
        </div>
        <footer>
            <?php
                footer($ruta);
            ?>
        </footer>
    </body>
    <!--Archivos Javascript-->
        <script type="text/javascript" src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="javascript/myFunction.js"></script>
    <!--Archivos Javascript-->
</html>
