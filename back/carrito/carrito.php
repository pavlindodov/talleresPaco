<?php
    include_once('../../estructuraPublica.php');
    include_once('../estructuraPrivada.php');
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
        <link href=../../css/content.css type=text/css rel=stylesheet>
        <link href=../../css/carrito.css type=text/css rel=stylesheet>
        <link href=../../css/background.css type=text/css rel=stylesheet>
        <link href=../../css/footer.css type=text/css rel=stylesheet>
        <title>Carrito</title>
    </head>
    <body>
        <header>
            <?php
                nav($ruta);
            ?>
        </header>
        <div class="allContainer">
            <div class=content>
                <?php
                    echo "<div class='comments'>";
                        if (!isset($_SESSION['dni'])) {
                            eliminarSession();
                            header("location:../../index.php?loginError=1");
                        }

                        if (isset($_GET['updateCarrito'])) {
                            if ($_GET['updateCarrito'] == 1) {
                                echo "<p style='color:green'>El producto se añadió al carrito correctamente.</p>";
                            }

                            if ($_GET['updateCarrito'] == 2) {
                                echo "<p style='color:green'>Se eliminó una unidad del carrito.</p>";
                            }

                            if ($_GET['updateCarrito'] == 3) {
                                echo "<p style='color:green'>El producto se eliminó del carrito correctamente.</p>";
                            }

                            if ($_GET['updateCarrito'] == 4) {
                                echo "<p style='color:green'>El carrito se vació correctamente.</p>";
                            }

                            if ($_GET['updateCarrito'] == 5) {
                                echo "<p style='color:red'>No hay unidades suficientes de alguno de los articulos.</p>";
                            }

                            if ($_GET['updateCarrito'] == 6) {
                                echo "<p style='color:green'>Su compra se realizó correctamente.</p>";
                            }
                        }
                    echo "</div>";
                ?>

                <div class="containerPost">
                    <?php
                        mostrarContenidoCarrito();
                    ?>
                </div>
            </div>
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
