<?php
    function esPositivo($numero) {
        return $numero >= 0;
    }

    function esEntero($entero) {
        $charAceptado = '0123456789';

        for ($i = 0; $i < strlen($entero); $i++) {
            if (strpos($charAceptado, substr($entero, $i, 1)) === false)
                return false;
        }
        return true;
    }

    function esDecimal($decimal) {
        $charAceptado = '0123456789.';

        for ($i = 0; $i < strlen($decimal); $i++)
            if (strpos($charAceptado, substr($decimal, $i, 1)) === false)
                return false;

        if (substr_count($decimal, '.') > 1)
            return false;

        if ($decimal[0] === '.')
            return false;

        return true;
    }

    /* -------------------------------------------- */
    /*         VALIDACIÓN FORMULARIO USUARIO        */
    /* -------------------------------------------- */

    function esDniValido($dni) {
        $patron = '/^[0-9]{8}[A-Za-z]?$|^[A-Za-z][0-9]{7}[A-Za-z]?$/';
        return preg_match($patron, $dni) === 1;
    }

    function esPasswdValido($passwd) {
        $longitud = strlen($passwd);
        $switch = false;
        $cont = 0;
        $contChrMayus = 0;
        $contChrMinus = 0;
        $contChrEsp = 0;

        if ($longitud >= 8) {
            while ($switch == 0 && $cont < $longitud) {
                if (substr($passwd, $cont, 1) >= 'A' && substr($passwd, $cont, 1) <= 'Z') {
                    $contChrMayus++;
                } else if (substr($passwd, $cont, 1) >= 'a' && substr($passwd, $cont, 1) <= 'z') {
                    $contChrMinus++;
                } else {
                    $contChrEsp++;
                }

                if ($contChrMayus >= 1 && $contChrMinus >= 1 && $contChrEsp >= 1) {
                    $switch = true;
                } else {
                    $cont++;
                }
            }
            return $switch;
        } else {
            return $switch;
        }
    }

    function esCorreoValido($correo) {
        $numArroba = substr_count($correo, '@');
        if ($numArroba > 1 || $numArroba < 1)
            return false;

        $posArroba = strpos($correo, '@');
        $posPunto = strpos($correo, '.', $posArroba);
        if ($posPunto === false || $posPunto == $posArroba + 1)
            return false;

        if (strpos($correo, '..') !== false)
            return false;

        return true;
    }

    function esDniRepetido($dniNuevo, $dniExistente) {
        return ($dniNuevo == $dniExistente);
    }

    function esUsuarioRepetido($usuarioNuevo, $usuarioExistente) {
        return ($usuarioNuevo == $usuarioExistente);
    }

    function validarFormUsuario($telefono, $correo) {
        if (!esEntero($telefono))
            return "phoneError";

        if (!esCorreoValido($correo))
            return "mailError";
        return "";
    }

    function validarDniUsuario($dni) {
        if (!esDniValido($dni))
            return "dniError";
        return "";
    }

    function validarUsuarioRepetido($dniNuevo, $dniExistente, $usuarioNuevo, $usuarioExistente) {
        if (esDniRepetido($dniNuevo, $dniExistente) || esUsuarioRepetido($usuarioNuevo, $usuarioExistente))
            return 1;
        return "";
    }

    function validarPasswdUsuario($passwd) {
        if (!esPasswdValido($passwd))
            return "passwdError";
        return "";
    }

    /* -------------------------------------------- */
    /*        VALIDACIÓN FORMULARIO PRODUCTO        */
    /* -------------------------------------------- */

    function esPrecioValido($precio) {
        return $precio <= 9999999.99;
    }

    function esDescuentoValido($descuento) {
        return ($descuento >= 0 && $descuento <= 100);
    }

    function esFechaValida($fechaFormulario) {
        $hoy = date("Y-m-d");

        return ($fechaFormulario <= $hoy);
    }

    function validarFormProducto($fechaFabricacion, $precio, $stock, $descuento) {
        if (!esPositivo($precio) || !esDecimal($precio) || !esPrecioValido($precio))
            return "priceError";

        if (!esPositivo($stock) || !esEntero($stock))
            return "stockError";

        if (!esPositivo($descuento) || !esEntero($descuento) || !esDescuentoValido($descuento))
            return "discountError";

        if (!esFechaValida($fechaFabricacion))
            return "dateError";

        return "";
    }

    /* -------------------------------------------- */
    /*                    CARRITO                   */
    /* -------------------------------------------- */

    function agregarAlCarrito($nuevoProducto, $op) {
        if (!isset($_SESSION['carrito']))
            $_SESSION['carrito'] = array();

        foreach ($_SESSION['carrito'] as &$producto) {
            if ($producto['id'] === $nuevoProducto['id']) {
                $producto['cantidad'] += $op;
                return;
            }
        }

        $_SESSION['carrito'][] = array(
            'id' => $nuevoProducto['id'],
            'modelo' => $nuevoProducto['modelo'],
            'marca' => $nuevoProducto['marca'],
            'serie' => $nuevoProducto['serie'],
            'fechaFabricacion' => $nuevoProducto['fechaFabricacion'],
            'precioProducto' => $nuevoProducto['precioProducto'],
            'stock' => $nuevoProducto['stock'],
            'descuento' => $nuevoProducto['descuento'],
            'imgArticulo' => $nuevoProducto['imgArticulo'],
            'cantidad' => $op
        );
    }

    function eliminarDelCarrito($idProducto) {
        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $i => $producto) {
                if ($producto['id'] === $idProducto) {
                    unset($_SESSION['carrito'][$i]);
                    break;
                }
            }
        }
    }

    function eliminarUnidadDelCarrito($idProducto) {
        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $i => $producto) {
                if ($producto['id'] === $idProducto) {
                    if ($producto['cantidad'] < 1) {
                        unset($_SESSION['carrito'][$i]);
                        break;
                    }
                }
            }
        }
    }
?>
