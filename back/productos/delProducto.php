<?php
    include_once('../sql/conexion.php');
    session_start();

    $id = $_GET['id'];

    $conexion = conectar();
    $consulta = "DELETE FROM producto WHERE id='$id'";
    $conexion->query($consulta);
    desconectar($conexion);

    header("location:listProducto.php?product=delSuccess");
    exit();
?>
