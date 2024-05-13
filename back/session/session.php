<?php
    function crearSession ($dni, $nombre, $apellidos, $usuario, $passwd, $idRol, $imgPerfil) {
        if(session_status() !== PHP_SESSION_ACTIVE) session_start();
        $_SESSION['dni'] = $dni;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellidos'] = $apellidos;
        $_SESSION['usuario'] = $usuario;
        $_SESSION['passwd'] = $passwd;
        $_SESSION['idRol'] = $idRol;
        $_SESSION['imgPerfil'] = $imgPerfil;
    }

    function eliminarSession() {
        if(session_status() !== PHP_SESSION_ACTIVE) session_start();
            session_destroy();
    }
?>
