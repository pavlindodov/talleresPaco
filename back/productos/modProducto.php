<?php
    include_once('../sql/conexion.php');
    include_once('../funciones.php');
    session_start();

    $id = $_SESSION['producto']['id'];
    unset($_SESSION['producto']['id']);

    $fechaFabricacion = $_POST['fechaFabricacion'];
    $precio= $_POST['precio'];
    $stock = $_POST['stock'];
    $descuento = $_POST['descuento'];

    $registroError = validarFormProducto($fechaFabricacion, $precio, $stock, $descuento);

    if ($registroError == "") {
        $modelo = $_POST['modelo'];
        $marca = $_POST['marca'];
        $serie = $_POST['serie'];
        $fname = $_POST['imgArticulo'];

        if (($_FILES['ffile']['name'] !='')) {
            $ruta = '../img/imgProductos/';
            $rutaImg = $ruta.$id.$_FILES['ffile']['name'];
            if ($fname != "default.png")
                unlink($ruta.$fname);
            move_uploaded_file($_FILES['ffile']['tmp_name'], $rutaImg);
            $fname = $id.$_FILES['ffile']['name'];
        }

        $conexion = conectar();
        $consulta = "UPDATE producto SET id='$id', modelo='$modelo', marca='$marca', serie='$serie', fechaFabricacion='$fechaFabricacion', precioProducto='$precio', stock='$stock', descuento='$descuento', imgArticulo='$fname' WHERE id='$id'";

        $conexion->query($consulta);

        desconectar($conexion);

        header("location:listProducto.php?product=modSuccess");
        exit();
    } else {
        header("location:detailProducto.php?product=$registroError&id=".$id);
        exit();
    }
?>
