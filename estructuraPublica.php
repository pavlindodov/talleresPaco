<?php
    function nav($ruta) {
        echo "
        <nav class='navbar'>
            <div class='mainMenu'>
                <span class='hoverBorder'>
                    <a href=".$ruta."index.php>Inicio</a>
                </span>
                <span class='hoverBorder'>
                    <a href=".$ruta."tienda.php>Productos</a>
                </span>";
        if (isset($_SESSION['dni']) && $_SESSION['idRol'] != 1) {
            echo "
                <div class='subnav'>
                    <div class=subnavdrop>".$_SESSION['usuario']."</div>
                    <div class=subnav-content>
                    <a href='".$ruta."back/usuario/formPerfil.php'>Perfil</a>
                    <a href='".$ruta."back/carrito/carrito.php'>Carrito</a>
                    <a href='".$ruta."back/pedidos/pedidos.php'>Pedidos</a>
                    <a href='".$ruta."back/session/logout.php'>Cerrar Sesión</a>
                    </div>
                </div>
            </div>
            <div class='imgLogotipo'>
                <img src='".$ruta."back/img/imgPagina/logotipo.png' alt='logotipo.png'>
            </div>
            <div class='imgPerfil'>
                <img src='".$ruta."back/img/imgPerfil/".$_SESSION['imgPerfil']."' alt='".$_SESSION['imgPerfil']."'>
            </div>";
        } elseif (isset($_SESSION['dni']) && $_SESSION['idRol'] == 1) {
            echo "
                <div class='subnav'>
                    <div class=subnavdrop>".$_SESSION['usuario']."</div>
                    <div class=subnav-content>
                        <a href='".$ruta."back/usuario/formPerfil.php'>Perfil</a>
                        <a href='".$ruta."back/productos/listProducto.php'>Gestión de Productos</a>
                        <a href='".$ruta."back/carrito/carrito.php'>Carrito</a>
                        <a href='".$ruta."back/pedidos/pedidos.php'>Pedidos</a>
                        <a href='".$ruta."back/session/logout.php'>Cerrar Sesión</a>
                    </div>
                </div>
            </div>
            <div class='imgLogotipo'>
                <img src='".$ruta."back/img/imgPagina/logotipo.png' alt='logotipo.png'>
            </div>
            <div class='imgPerfil'>
                <img src='".$ruta."back/img/imgPerfil/".$_SESSION['imgPerfil']."' alt='".$_SESSION['imgPerfil']."'>
            </div>";
        } else {
                echo "
                <span class='hoverBorder'>
                    <a href='".$ruta."formIniciarSesion.php'>Iniciar Sesión</a>
                </span>
            </div>
            <div class='imgLogotipo'>
                <img src='".$ruta."back/img/imgPagina/logotipo.png' alt='logotipo.png'>
            </div>
            <div></div>";

            }
        echo "</nav>";
    }

    function footer($ruta){
        echo "
        <div id='footerContainer'>
            <div class='redes-footer'>
                <div tabindex='-1'>
                    <a tabindex='0' href='".$ruta."index.php' target='_blank'>
                        <i class='fab fa-facebook-f icon-redes-footer'></i>
                    </a>
                </div>
                <div tabindex='-1'>
                    <a tabindex='0' href='".$ruta."index.php' target='_blank'>
                        <i class='fab fa-telegram icon-redes-footer'></i>
                    </a>
                </div>
                <div tabindex='-1'>
                    <a tabindex='0' href='".$ruta."index.php' target='_blank'>
                        <i class='fab fa-instagram icon-redes-footer'></i>
                    </a>
                </div>
            </div>
            <h4>© 2023. All rights reserved</h4>
        </div>
        ";
    }

    function loginFormStyle() {
        echo "
        <form class='form' method='post' action='back/session/login.php'>
            <h3>Iniciar sesión:</h3></br>
            <label for='usuario'>Usuario:</label><br>
            <input type='text' id='usuario' name='usuario' required></br>

            <label for='passwd'>contraseña:</label><br>
            <input type='password' id='passwd' name='passwd' required></br>

            <div class='buttonContainer'>
                <p class='enlaceRegistrar'><a href='formRegistro.php'>¿No tienes cuenta?</a></p></br>
                <button class='buttonForm' type='submit'>Iniciar Sesión</button>
            </div>

        </form>";
    }

    function registerFormStyle() {
        echo "
        <form class='form' method='post' action='back/session/register.php'>
            <h3>Registrarse:</h3></br>
            <label for='usuario'>*Usuario:</label><br>
            <input type='text' id='usuario' name='usuario' maxlength='15' required><br>

            <label for='passwd'>*Contraseña:</label><br>
            <input type='password' id='passwd' name='passwd' minlength='8' required><br>

            <label for='dni'>*DNI/NIE:</label><br>
            <input type='text' id='dni' name='dni' minlength='9' maxlength='9' required><br>

            <label for='nombre'>*Nombre:</label><br>
            <input type='text' id='nombre' name='nombre' maxlength='15' required><br>

            <label for='apellidos'>*Apellidos:</label><br>
            <input type='text' id='apellidos' name='apellidos' maxlength='30' required><br>

            <label for='telefono'>*Teléfono:</label><br>
            <input type='text' id='telefono' name='telefono' minlength='9' maxlength='9' required><br>

            <label for='correo'>*Correo Electrónico:</label><br>
            <input type='mail' id='correo' name='correo' maxlength='30' required><br><br>

            <div class='buttonContainer'>
                <button class='buttonForm' type='submit'>Registrar</button>
            </div>
      </form>";
    }
?>
