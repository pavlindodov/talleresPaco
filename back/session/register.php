<?php
    include_once('../sql/conexion.php');
    include_once('session.php');
    include_once('../funciones.php');

    if (isset($_POST['dni']) && isset($_POST['usuario'])) {
        $conexion = conectar();
        $consulta = "SELECT dni, usuario FROM usuario";

        $resultado = $conexion->query($consulta);
        $filas = mysqli_affected_rows($conexion);
        desconectar($conexion);

        while ($registro = $resultado->fetch_assoc()) {
            if (validarUsuarioRepetido($_POST['dni'], $registro['dni'], $_POST['usuario'], $registro['usuario']) == true) {
                header("location:../../formRegistro.php?registerError=1");
                exit();
            }
        }

        $passwd = $_POST['passwd'];
        if (validarPasswdUsuario($passwd) == "passwdError"){
            header("location:../../formRegistro.php?profileRegister=passwdError");
            exit();
        }
        $passwd = hash('sha256', $passwd);

        $dni = $_POST['dni'];
        if (validarDniUsuario($dni) == "dniError") {
            header("location:../../formRegistro.php?profileRegister=dniError");
            exit();
        }

        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];

        $registroError = validarFormUsuario($telefono, $correo);

        if ($registroError == "") {
            $usuario = $_POST['usuario'];
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $imgPerfil = "default.jpg";

            $conexion = conectar();
            $consulta="INSERT INTO usuario VALUES ('$dni', '$nombre', '$apellidos', '$usuario', '$passwd', 2, '$correo', '$telefono', '$imgPerfil')";

            $conexion->query($consulta);

            desconectar($conexion);

            crearSession($dni, $nombre, $apellidos, $usuario, $passwd, 2, $imgPerfil);

            header("location:../../index.php?registerSuccess=1");
            exit();
        } else {
            header("location:../../formRegistro.php?profileRegister=$registroError");
            exit();
        }
    }
?>
