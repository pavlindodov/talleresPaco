<?php
    include_once('../sql/conexion.php');
    include_once('../funciones.php');
    session_start();

    $fechaFabricacion = $_POST['fechaFabricacion'];
    $precio= $_POST['precio'];
    $stock = $_POST['stock'];
    $descuento = $_POST['descuento'];

    $registroError = validarFormProducto($fechaFabricacion, $precio, $stock, $descuento);

    if ($registroError == "") {
        $modelo = $_POST['modelo'];
        $marca = $_POST['marca'];
        $serie = $_POST['serie'];
        $fname = "default.png";

        if (($_FILES['ffile']['name'] !='')) {
			$ruta = '../img/imgProductos/';
            $rutaImg = $ruta.$_FILES['ffile']['name'];
            move_uploaded_file($_FILES['ffile']['tmp_name'], $rutaImg);
            $fname = $_FILES['ffile']['name'];
        }

        $conexion = conectar();
        $consulta="INSERT INTO producto (modelo, marca, serie, fechaFabricacion, precioProducto, stock, descuento, imgArticulo) VALUES ('$modelo', '$marca', '$serie', '$fechaFabricacion', '$precio', '$stock', '$descuento', '$fname')";

        $conexion->query($consulta);

        desconectar($conexion);

        header("location:listProducto.php?product=fullSuccess");
        exit();
    } else {
        header("location:listProducto.php?product=$registroError");
        exit();
    }
?>
