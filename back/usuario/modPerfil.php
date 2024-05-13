<?php
    include_once('../sql/conexion.php');
    include_once('../session/session.php');
    include_once('../funciones.php');
    session_start();

    $passwd = $_SESSION['passwd'];


    if (isset($_POST['passwd']) && !empty($_POST['passwd'])) {
        $passwd = $_POST['passwd'];
        if (validarPasswdUsuario($passwd) == "passwdError") {
            header("location:formPerfil.php?profile=passwdError");
            exit();
        }
        $passwd = hash('sha256', $passwd);
    }


    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    $registroError = validarFormUsuario($telefono, $correo);

    if ($registroError == "") {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $fname = $_POST['imgPerfil'];

        $dni = $_SESSION['dni'];
        $usuario = $_SESSION['usuario'];
        $idRol = $_SESSION['idRol'];

        if ($_FILES['ffile']['name'] != '') {
            $ruta = '../img/imgPerfil/';
            $rutaImg = $ruta.$usuario.$_FILES['ffile']['name'];
            if ($fname != "default.jpg")
                unlink($ruta.$fname);
            move_uploaded_file($_FILES['ffile']['tmp_name'], $rutaImg);
            $fname = $usuario.$_FILES['ffile']['name'];
        }

        $conexion = conectar();
        $consulta = "UPDATE usuario SET dni='$dni', nombre='$nombre', apellidos='$apellidos', usuario='$usuario', contrasenia='$passwd', correo='$correo', telefono='$telefono', imgPerfil='$fname' WHERE dni='$dni'";

        $conexion->query($consulta);

        desconectar($conexion);

        crearSession($dni, $nombre, $apellidos, $usuario, $passwd, $idRol, $fname);
        header("location:formPerfil.php?profile=updateSuccess");
        exit();
    }
    else {
        header("location:formPerfil.php?profile=$registroError");
        exit();
    }
?>
