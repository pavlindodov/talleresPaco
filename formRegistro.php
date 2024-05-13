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
        <title>Registrarse</title>
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
                    if (isset($_GET['registerError'])) {
                        if ($_GET['registerError'] == 1) {
                            echo "<p style='color:red'>Nombre de usuario o DNI inválido.</p>";
                        }
                    }

                    if (isset($_GET['profileRegister'])) {
                        if ($_GET['profileRegister'] == "passwdError") {
                            echo "<p style='color:red'>La contraseña introducida es demasiado débil.</p>";
                        }

                        if ($_GET['profileRegister'] == "dniError") {
                            echo "<p style='color:red'>El formato DNI/NIF no es aceptado.</p>";
                        }

                        if ($_GET['profileRegister'] == "phoneError") {
                            echo "<p style='color:red'>El teléfono introducido es incorrecto.</p>";
                        }

                        if ($_GET['profileRegister'] == "mailError") {
                            echo "<p style='color:red'>El correo electrónico introducido es incorrecto.</p>";
                        }
                    }
                echo "</div>";
                registerFormStyle();
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
