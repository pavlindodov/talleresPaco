<?php
    include_once ('estructuraPublica.php');
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
        <link href=css/form.css type=text/css rel=stylesheet>
        <link href=css/background.css type=text/css rel=stylesheet>
        <link href=css/buttons.css type=text/css rel=stylesheet>
        <link href=css/content.css type=text/css rel=stylesheet>
        <link href=css/footer.css type=text/css rel=stylesheet>
        <title>Iniciar Sesión</title>
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
                    if (isset($_GET['loginError'])) {
                        if ($_GET['loginError'] == 1) {
                            echo "<p style='color:red'>Introduce los datos de autenticación.</p>";
                        } else if ($_GET['loginError'] == 2) {
                            echo "<p style='color:red'>Usuario o contraseña incorrecta.</p>";
                        }
                    }
                echo "</div>";
                loginFormStyle();
            ?>
        </div>
        <footer>
            <?php
                footer($ruta);
            ?>
        </footer>
    </body>
    <!--Archivos Javascript-->
        <script type="text/javascript" src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <!--Archivos Javascript-->
</html>
