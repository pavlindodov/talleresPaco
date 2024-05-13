<?php
    include_once('../../estructuraPublica.php');
    include_once ('../estructuraPrivada.php');
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
        <link href=../../css/background.css type=text/css rel=stylesheet>
        <link href=../../css/form.css type=text/css rel=stylesheet>
        <link href=../../css/content.css type=text/css rel=stylesheet>
        <link href=../../css/buttons.css type=text/css rel=stylesheet>
        <link href=../../css/formProductos.css type=text/css rel=stylesheet>
        <link href=../../css/footer.css type=text/css rel=stylesheet>

        <title>Gestión de Productos</title>
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
                        exit();
                    }

                    if (isset($_GET['product'])) {
                        if ($_GET['product'] == "dateError") {
                            echo "<p style='color:red'>La fecha no puede ser mayor a la de hoy.</p><br>";
                        }

                        if ($_GET['product'] == "priceError") {
                            echo "<p style='color:red'>El precio introducido es incorrecto.</p><br>";
                        }

                        if ($_GET['product'] == "stockError") {
                            echo "<p style='color:red'>El stock introducido es incorrecto.</p><br>";
                        }

                        if ($_GET['product'] == "discountError") {
                            echo "<p style='color:red'>El descuento introducido es incorrecto.</p><br>";
                        }

                        if ($_GET['product'] == "fullSuccess") {
                            echo "<p style='color:green'>El artículo se añadió correctamente.</p><br>";
                        }

                        if ($_GET['product'] == "modSuccess") {
                            echo "<p style='color:green'>El artículo se modificó correctamente.</p><br>";
                        }

                        if ($_GET['product'] == "delSuccess") {
                            echo "<p style='color:green'>El artículo se eliminó correctamente.</p><br>";
                        }
                    }
                echo "</div>";
            ?>
        </div>
            <div class="container">
                <div>
                    <?php
                        addProductoFormStyle();
                    ?>
                </div>
                <div class="tableContainer">
                    <?php
                        $conexion = conectar();
                        $consulta = "SELECT * FROM producto";

                        $resultado = $conexion->query($consulta);

                        desconectar($conexion);

                        echo"
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Modelo</th>
                                <th>Marca</th>
                                <th>Serie</th>
                                <th>Fecha Fabricación</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Descuento</th>
                                <th>Imagen</th>
                                <th>...</th>
                            </tr>";

                        while ($registro = $resultado->fetch_assoc()) {
                            $id = $registro['id'];
                            $modelo = $registro['modelo'];
                            $marca = $registro['marca'];
                            $serie = $registro['serie'];
                            $fechaFabricacion = $registro['fechaFabricacion'];
                            $precioProducto = $registro['precioProducto'];
                            $stock = $registro['stock'];
                            $descuento = $registro['descuento'];
                            $imgArticulo = $registro['imgArticulo'];

                            echo "
                            <tr>
                                <td>".$id."</td>
                                <td>".$modelo."</td>
                                <td>".$marca."</td>
                                <td>".$serie."</td>
                                <td>".$fechaFabricacion."</td>
                                <td>".$precioProducto."</td>
                                <td>".$stock."</td>
                                <td>".$descuento."</td>
                                <td>".$imgArticulo."</td>
                                <td>
                                    <a tabindex='0' href='detailProducto.php?id=".$id."'>
                                        <button class='buttonForm'>Modificar</button>
                                    </a>
                                </td>
                            </tr>";
                        }
                        echo "</table>";
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
