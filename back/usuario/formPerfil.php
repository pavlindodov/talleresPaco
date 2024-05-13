<?php
    include_once('../../estructuraPublica.php');
    include_once '../estructuraPrivada.php';
    include_once('../sql/conexion.php');
    include_once('../session/session.php');
    session_start();
    $ruta = "../../";
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../img/imgPagina/logotipo.png">
        <link href=../../css/main.css type=text/css rel=stylesheet>
        <link href=../../css/nav.css type=text/css rel=stylesheet>
        <link href=../../css/form.css type=text/css rel=stylesheet>
        <link href=../../css/background.css type=text/css rel=stylesheet>
        <link href=../../css/content.css type=text/css rel=stylesheet>
        <link href=../../css/buttons.css type=text/css rel=stylesheet>
        <link href=../../css/footer.css type=text/css rel=stylesheet>
        <title>Perfil</title>
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
                    if (!isset($_SESSION['dni'])) {
                        eliminarSession();
                        header("location:../../index.php?loginError=1");
                    }

                    if (isset($_GET['profile'])) {
                        if ($_GET['profile'] == "passwdError") {
                            echo "<p style='color:red'>La contraseña introducida es demasiado débil.</p>";
                        }

                        if ($_GET['profile'] == "phoneError") {
                            echo "<p style='color:red'>El teléfono introducido es incorrecto.</p>";
                        }

                        if ($_GET['profile'] == "mailError") {
                            echo "<p style='color:red'>El correo electrónico introducido es incorrecto.</p>";
                        }

                        if ($_GET['profile'] == "updateSuccess") {
                            echo "<p style='color:green'>Se ha actualizado correctamente.</p>";
                        }
                    }
                echo "</div>";

                $dni = $_SESSION['dni'];
                $conexion = conectar();
                $consulta = "SELECT nombre, apellidos, usuario, correo, telefono, imgPerfil FROM usuario WHERE dni='$dni'";

                $resultado = $conexion->query($consulta);
                $filas = mysqli_affected_rows($conexion);

                desconectar($conexion);

                if ($filas == 1) {
                    $registro = $resultado->fetch_assoc();
                    $_SESSION['nombre'] = $registro['nombre'];
                    $_SESSION['apellidos'] = $registro['apellidos'];
                    $_SESSION['usuario'] = $registro['usuario'];
                    $_SESSION['correo'] = $registro['correo'];
                    $_SESSION['telefono'] = $registro['telefono'];
                    $_SESSION['imgPerfil'] = $registro['imgPerfil'];
                }

                modPerfilFormStyle();
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
