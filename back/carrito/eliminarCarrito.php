<?php
    include_once('../sql/conexion.php');
    include_once('../session/session.php');
    session_start();

    if (isset($_GET['origen']))
        $origen = $_GET['origen'];

    if (isset($_SESSION['carrito']))
        unset($_SESSION['carrito']);

    if ($origen == "comprar") {
        header("location:carrito.php?updateCarrito=6");
        exit();
    }
    
    header("location:carrito.php?updateCarrito=4");
    exit();
?>
