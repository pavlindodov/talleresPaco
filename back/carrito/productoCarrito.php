<?php
    include_once('../sql/conexion.php');
    include_once('../session/session.php');
    include_once('../funciones.php');
    session_start();

    if (isset($_GET['id']))
        $id = $_GET['id'];

    if (isset($_GET['op']))
        $op = $_GET['op'];

    if (isset($_GET['origen']))
        $origen = $_GET['origen'];

    $conexion = conectar();
    $consulta = "SELECT * FROM producto WHERE id='$id'";
    $resultado = $conexion->query($consulta);

    desconectar($conexion);


    $registro = $resultado->fetch_assoc();

    agregarAlCarrito($registro, $op);

    if ($origen == "tienda") {
        header("location:../../tienda.php?updateCarrito=1");
        exit();
    } else {
        if ($op > 0) {
            header("location:carrito.php?updateCarrito=1");
            exit();
        } else if ($op < 0) {
                eliminarUnidadDelCarrito($id);
                header("location:carrito.php?updateCarrito=2");
                exit();
        } else {
            eliminarDelCarrito($id);
            header("location:carrito.php?updateCarrito=3");
            exit();
        }
    }
?>
