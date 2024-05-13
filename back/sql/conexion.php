<?php
    include_once('credenciales.php');

    // Función para conectarse a la base de datos
        function conectar() {
            $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

            if (mysqli_connect_errno()) {
                $msg = "Database connection failed: ";
                $msg .= mysqli_connect_error();
                $msg .= " : " . mysqli_connect_errno();
                exit($msg);
            }

            return $db;
        }

    // Función para desconectarse de la base de datos
        function desconectar($db) {
            mysqli_close($db);
        }

        function beginTransaction($db) {
            mysqli_begin_transaction($db);
        }

        function commit($db){
            mysqli_commit($db);
        }

        function rollback($db){
            mysqli_rollback($db);
        }
?>
