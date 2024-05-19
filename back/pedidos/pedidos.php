<?php
    include_once('../../estructuraPublica.php');
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
        <link rel="shortcut icon" href="back/img/imgPagina/logotipo.png">
        <link href=../../css/main.css type=text/css rel=stylesheet>
        <link href=../../css/nav.css type=text/css rel=stylesheet>
        <link href=../../css/pedidos.css type=text/css rel=stylesheet>
        <link href=../../css/background.css type=text/css rel=stylesheet>
        <link href=../../css/footer.css type=text/css rel=stylesheet>
        <title>Inicio</title>
    </head>
    <body>
        <header>
            <?php
                nav($ruta);

                echo "<div class='comments'>";
                    if (!isset($_SESSION['dni'])) {
                        eliminarSession();
                        header("location:../../index.php?loginError=1");
                    }
                echo "</div>";
            ?>
        </header>
        <?php
            $dni = $_SESSION['dni'];
            $precioTotalProductos = 0;

            $conexion = conectar();

            if ($_SESSION['idRol'] != 1)
                $consulta = "SELECT * FROM factura WHERE dniCliente='$dni' ORDER BY id DESC";
            else
                $consulta = "SELECT * FROM factura ORDER BY id DESC";
            
            $resultado = $conexion->query($consulta);
            $filas = mysqli_affected_rows($conexion);

            if ($filas > 0) {
                while ($registro = $resultado->fetch_assoc()) {
                    $idFactura = $registro['id'];
                    $dniCliente = $registro['dniCliente'];
                    $fechaFactura = $registro['fechaFactura'];

                    echo "
                    <div class='container'>

                        <div class='infoContainer'>
                            <div>
                                <p>Nº Factura: ".$idFactura."</p>
                            </div>
                            <div>
                                <p>DNI/NIF: ".$dniCliente."</p>
                            </div>
                            <div>
                                <p>Fecha: ".$fechaFactura."</p>
                            </div>
                        </div>

                        <div class='tableContainer'>
                            <table>
                                <tr>
                                    <th>Productos</th>
                                    <th>Cantidad</th>
                                    <th>Precio unitario</th>
                                    <th>Total</th>
                                </tr>";

                                $consulta="SELECT p.modelo, p.marca, l.cantidad, l.precioUd FROM lineaFactura l JOIN producto p ON p.id=l.idProducto WHERE l.idFactura='$idFactura'";
                                $resultado2 = $conexion->query($consulta);
                                while ($registro = $resultado2->fetch_assoc()) {
                                    $modelo = $registro['modelo'];
                                    $marca = $registro['marca'];
                                    $cantidad = $registro['cantidad'];
                                    $precioProducto = $registro['precioUd'];

                                    $precioTotalProductos = $precioTotalProductos+($precioProducto*$cantidad);

                                    echo"
                                    <tr>
                                        <td>".$marca." ".$modelo."</td>
                                        <td>".$cantidad."</td>
                                        <td>".$precioProducto."</td>
                                        <td>".$precioProducto*$cantidad." €</td>
                                    </tr>";
                                }
                                echo"
                                <tr>
                                    <td colspan='3' class='tdTotal'>Total:</td>
                                    <td>".$precioTotalProductos." €</td>
                                </tr>
                            </table>
                        </div>

                    </div>";
                    $precioTotalProductos = 0;
                }
                desconectar($conexion);
            } else {
                echo "
                <div class='pedidosVacios'>
                    <p>No se ha encontrado ningún registro.</p>
                </div>";
            }
        ?>
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
