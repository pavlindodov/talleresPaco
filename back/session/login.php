<?php
    include_once('../sql/conexion.php');
    include_once('../session/session.php');

    if ((isset($_POST['usuario']) && $_POST['usuario']!="") && (isset($_POST['passwd']) && $_POST['passwd']!="")) {
        $usuario = $_POST['usuario'];
        $passwd = $_POST['passwd'];
        $passwd = hash('sha256', $passwd);

        $conexion = conectar();
        $consulta = "SELECT dni, nombre, apellidos, contrasenia, idRol, imgPerfil FROM usuario WHERE usuario='$usuario' AND contrasenia='$passwd'";

        $resultado = $conexion->query($consulta);
        $filas = mysqli_affected_rows($conexion);

        desconectar($conexion);

        if ($filas == 1) {
            $registro = $resultado->fetch_assoc();
            $dni = $registro['dni'];
            $nombre = $registro['nombre'];
            $apellidos = $registro['apellidos'];
            $passwd = $registro['contrasenia'];
            $idRol = $registro['idRol'];
            $imgPerfil = $registro['imgPerfil'];

            crearSession($dni, $nombre, $apellidos, $usuario, $passwd, $idRol, $imgPerfil);
            header("location:../../index.php?loginSuccess=1");
            exit();
        } else {
            header("location:../../formIniciarSesion.php?loginError=2");
            exit();
        }
    } else {
        header("location:../../formIniciarSesion.php?loginError=1");
        exit();
    }
?>
