<?php
    include_once('../sql/conexion.php');
    include_once('../session/session.php');
    include_once('../funciones.php');
    session_start();

    $dni = $_SESSION['dni'];
    $precioTotal = $_GET['precioTotal'];

    $conexion = conectar();
    try {
        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
            beginTransaction($conexion);

            foreach ($_SESSION['carrito'] as $i => $producto) {
                if ($producto['cantidad'] > $producto['stock']) {
                    throw new Exception("Stock insuficiente para el producto " . $producto['id']);
                }
            }

            $consulta = "INSERT INTO factura (totalFactura, dniCliente, fechaFactura) VALUES ('$precioTotal', '$dni', now())";
            $conexion->query($consulta);

            $consulta = "SELECT * FROM factura ORDER BY id DESC LIMIT 1";
            $resultado = $conexion->query($consulta);
            $registro = $resultado->fetch_assoc();
            $idFactura = $registro['id'];

            foreach ($_SESSION['carrito'] as $i => $producto) {
                $cantidadVendida = $producto['cantidad'];
                $stock = $producto['stock'];
                $idProducto = $producto['id'];
                $cantidadRestante = $stock - $cantidadVendida;
                $precioProducto = $producto['precioProducto'];

                $consulta = "INSERT INTO lineaFactura VALUES ('$idFactura', '$idProducto', '$cantidadVendida', '$precioProducto')";
                $conexion->query($consulta);

                $consulta = "UPDATE producto SET stock='$cantidadRestante' WHERE id='$idProducto'";
                $conexion->query($consulta);
            }

            commit($conexion);
            desconectar($conexion);

            header("location:eliminarCarrito.php?origen=comprar");
            exit();
        }
    } catch (Exception $e) {
        rollback($conexion);

        header("location:carrito.php?updateCarrito=5");
        exit();
    }
?>
