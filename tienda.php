<?php
    include_once('estructuraPublica.php');
    include_once('back/estructuraPrivada.php');
    include_once('back/sql/conexion.php');
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
        <link href=css/background.css type=text/css rel=stylesheet>
        <link href=css/content.css type=text/css rel=stylesheet>
        <link href=css/tienda.css type=text/css rel=stylesheet>
        <link href=css/buttons.css type=text/css rel=stylesheet>
        <link href=css/footer.css type=text/css rel=stylesheet>
        <title>Productos</title>
    </head>
    <body>
        <header>
            <?php
                nav($ruta);
            ?>
        </header>

        <div class="containerPost">
            <div class=content>
                <?php
                    echo "<div class='comments'>";
                        if (isset($_GET['updateCarrito'])) {
                            if ($_GET['updateCarrito'] == 1) {
                                echo "<p style='color:green'>Se añadió al carrito correctamente.</p>";
                            }
                        }
                    echo "</div>";
                ?>
                <?php
                    $conexion = conectar();
                    $consulta = "SELECT * FROM producto";

                    $resultado = $conexion->query($consulta);

                    desconectar($conexion);

                    while ($registro = $resultado->fetch_assoc()) {
                        $id = $registro['id'];
                        $modelo = $registro['modelo'];
                        $marca = $registro['marca'];
                        $serie = $registro['serie'];
                        $fechaFabricacion = $registro['fechaFabricacion'];
                        $precioProducto = $registro['precioProducto'];
                        $stock = $registro['stock'];
                        $imgArticulo = $registro['imgArticulo'];

                        echo "
                        <div class='post'>
                            <div class='img'>
                                <img src='back/img/imgProductos/".$imgArticulo."' alt='".$imgArticulo."'>
                            </div>
                            <div class='text'>
                                <h2>".$marca."</h2>
                                <span>".$modelo."</span>
                                <h3>".$precioProducto." €</h3>
                            </div>
                            <ul class='tags'>
                                <li>Nº Serie: ".$serie."</li>
                                <li>Fecha de Fabricación: ".$fechaFabricacion."</li>
                                <li>Unidades en venta: ".$stock."</li>
                            </ul>";
                            if (isset($_SESSION["dni"])) {
                                if ($stock > 0) {
                                    botonCarrito($id);
                                } else {
                                    botonAgotado();
                                }
                            }
                        echo "</div></br>";
                    }
                ?>
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
