<?php
session_start();
session_unset();
session_destroy();
if (headers_sent()) {
    echo "<script>window.location.href = 'index.php?vista=login';</script>";
    exit(); /* Añadir un 'exit' para evitar que el script continúe. */
} else {
    header("Location: index.php?vista=login");
    exit(); /* Para asegurar de que el script se detenga después de la redirección */
}
?>
