<?php
    function modPerfilFormStyle() {
        echo "
        <form class='form' method='post' action='modPerfil.php' enctype='multipart/form-data'>
            <h3>Actualizar perfil:</h3></br>
            <label for='usuario'>Usuario: <span style='color:red'>No se puede modificar.</span></label></br>
            <input type='text' id='usuario' name='usuario' placeholder=".$_SESSION['usuario']." readonly></br>

            <label for='passwd'>contraseña:</label></br>
            <input type='password' id='passwd' name='passwd' minlength='8' placeholder='******************'></br>

            <label for='dni'>DNI/NIE: <span style='color:red'>No se puede modificar.</span></label></br>
            <input type='text' id='dni' name='dni' placeholder=".$_SESSION['dni']." readonly></br>

            <label for='nombre'>Nombre:</label></br>
            <input type='text' id='nombre' name='nombre' maxlength='15' value=".$_SESSION['nombre']."></br>

            <label for='apellidos'>Apellidos:</label></br>
            <input type='text' id='apellidos' name='apellidos' maxlength='30' value=".$_SESSION['apellidos']."></br>

            <label for='telefono'>Teléfono:</label></br>
            <input type='text' id='telefono' name='telefono' minlength='9' maxlength='9' value=".$_SESSION['telefono']."></br>

            <label for='correo'>Correo Electrónico:</label></br>
            <input type='mail' id='correo' name='correo' maxlength='30' value=".$_SESSION['correo']."></br></br>


            <label class='imgLabel' for='ffile'>Subir foto de perfil</label></br>
            <input type='file' id='ffile' name='ffile'></br>
            <input type='hidden' id='imgPerfil' name='imgPerfil' value=".$_SESSION['imgPerfil'].">";

            echo "
            <div class='buttonContainer'>
                <button class='buttonForm' type='submit'>Actualizar</button>
            </div>
        </form>";
    }

    function addProductoFormStyle() {
        echo "
        <form class='form' method='post' action='addProducto.php' enctype='multipart/form-data'>
            <h3>Añadir nuevo producto:</h3></br>

            <label for='modelo'>Modelo:</label></br>
            <input type='text' id='modelo' name='modelo' maxlength='40' required></br>

            <label for='marca'>Marca:</label></br>
            <input type='text' id='marca' name='marca' maxlength='40' required></br>

            <label for='serie'>Serie:</label></br>
            <input type='text' id='serie' name='serie' maxlength='40' required></br>

            <label for='precio'>Precio del Producto:</label></br>
            <input type='text' id='precio' name='precio' maxlength='10' required></br>

            <label for='stock'>Stock:</label></br>
            <input type='text' id='stock' name='stock' maxlength='9' required></br>

            <label for='descuento'>Descuento:</label></br>
            <input type='text' id='descuento' name='descuento' maxlength='3' required></br></br>

            <label for='fechaFabricacion'>Fecha de Fabricación:</label></br>
            <input type='date' id='fechaFabricacion' name='fechaFabricacion' required></br></br>

            <label class='imgLabel' for='ffile'>Subir Imagen del Producto (opcional)</label></br>
            <input type='file' id='ffile' name='ffile'></br></br>

            <div class='buttonContainer'>
                <button class='buttonForm' type='submit'>Añadir a base de datos</button>
            </div>
        </form>";
    }

    function modProductoFormStyle() {
        echo "
            <tr>
                <form class='form' method='post' action='modProducto.php' enctype='multipart/form-data'>
                    <td>
                        <input type='text' id='id' name='id' placeholder=".$_SESSION['producto']['id']." readonly>
                    </td>

                    <td>
                        <input type='text' id='modelo' name='modelo' maxlength='40' value=".$_SESSION['producto']['modelo'].">
                    </td>

                    <td>
                        <input type='text' id='marca' name='marca' maxlength='40' value=".$_SESSION['producto']['marca'].">
                    </td>

                    <td>
                        <input type='text' id='serie' name='serie' maxlength='40' value=".$_SESSION['producto']['serie'].">
                    </td>

                    <td>
                        <input type='date' id='fechaFabricacion' name='fechaFabricacion' value=".$_SESSION['producto']['fechaFabricacion'].">
                    </td>

                    <td>
                        <input type='text' id='precio' name='precio' maxlength='10' value=".$_SESSION['producto']['precioProducto'].">
                    </td>

                    <td>
                        <input type='text' id='stock' name='stock' maxlength='9' value=".$_SESSION['producto']['stock'].">
                    </td>

                    <td>
                        <input type='text' id='descuento' name='descuento' maxlength='3' value=".$_SESSION['producto']['descuento'].">
                    </td>

                    <td>
                        <label class='imgLabel' for='ffile'>Subir</label>
                        <input type='file' id='ffile' name='ffile'>
                        <input type='hidden' id='imgArticulo' name='imgArticulo' value=".$_SESSION['producto']['imgArticulo'].">
                    </td>

                    <td>
                        <button class='buttonForm' type='submit'>Actualizar</button>
                    </td>
                </form>

                <td>
                    <a tabindex='0' href='delProducto.php?id=".$_SESSION['producto']['id']."'>
                        <button id='buttonDelete' class='buttonForm'>Eliminar</button>
                    </a>
                </td>
            </tr>
        ";
        foreach ($_SESSION['producto'] as $i => $c)
            if ($i != "id")
                unset($_SESSION[$i]);
    }

    function botonCarrito($id) {
        echo "
        <div class='buttons'>
            <div class='buttonCarrito'>
                <a tabindex='0' href='back/carrito/productoCarrito.php?id=".$id."&op=1&origen=tienda'>
                    <button tabindex='-1'>Añadir a carrito</button>
                </a>
            </div>
        </div>";
    }

    function botonAgotado() {
        echo "
        <div class='buttons'>
            <div class='buttonAgotado'>
                <button tabindex='-1'>Agotado</button>
            </div>
        </div>";
    }

    function mostrarContenidoCarrito() {
        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
            $cantidadTotal = 0;
            $precioTotal = 0;
            foreach ($_SESSION['carrito'] as $producto) {
                $cantidadTotal += $producto['cantidad'];
                $precioTotal += $producto['precioProducto'] * $producto['cantidad'];
                echo "
                <div class='post'>
                    <div class='img'>
                        <img src='../img/imgProductos/".$producto['imgArticulo']."' alt='".$producto['imgArticulo']."'>
                    </div>
                    <div class='text'>
                        <h2>".$producto['marca']."</h2>
                        <span>".$producto['modelo']."</span>
                    </div>
                    <div class='text'>
                        <span>Nº Serie: ".$producto['serie']."</span>
                    </div>
                    <div class='text'>
                        <span>Ud. Disponibles: ".$producto['stock']."</span>
                        <span>Ud. Seleccionadas: ".$producto['cantidad']."</span>
                        <div class='buttonsOp'>
                            <div class='buttonOp'>
                                <a tabindex='0' href='productoCarrito.php?id=".$producto['id']."&op=-1&origen=carrito'>
                                    <button tabindex='-1'>-1</button>
                                </a>
                            </div>
                            <div class='buttonOp'>
                                <a tabindex='0' href='productoCarrito.php?id=".$producto['id']."&op=1&origen=carrito'>
                                    <button tabindex='-1'>+1</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class='text'>
                        <h3>".$producto['precioProducto']." €/Ud.</h3>
                    </div>
                    <div class='buttonOpEliminar'>
                    <a tabindex='0' href='productoCarrito.php?id=".$producto['id']."&op=0&origen=carrito'>
                        <button tabindex='-1'>Eliminar</button>
                    </a>
                </div>
                </div><br>";
            }

            echo "
            <div class='buttons'>
                <div class='buttonComprar'>
                    <a tabindex='0' href='comprar.php?precioTotal=$precioTotal'>
                        <button tabindex='-1'>Comprar</button>
                    </a>
                </div>
                <div class='buttonEliminar'>
                    <a tabindex='0' href='eliminarCarrito.php'>
                        <button tabindex='-1'>Vaciar Carrito</button>
                    </a>
                </div><br><br>
                <div class='precioTotal'>
                    <h3>Cantidad(".$cantidadTotal.") ".$precioTotal."€</h3>
                </div>
            </div>";
        } else {
            echo "
            <div class='imgCarritoVacio'>
                <img src='../img/imgProductos/carritoVacio.png' alt='carritoVacio.png'>
            </div>";
        }
    }
?>
