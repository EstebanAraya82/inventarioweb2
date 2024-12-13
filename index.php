<?php
ob_start();
require "./inc/session_start.php";
?> 
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include "./inc/head.php"; ?>
</head>
<body>
    <?php
    /* Redirigir a login si no existe una sesión */
    if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
        $_GET['vista'] = "login";
    }

    /* Vista por defecto si no está definida */
    if (!isset($_GET['vista']) || $_GET['vista'] == "") {
        $_GET['vista'] = "login";
    }

    /* Rutas protegidas: Verificar si la vista existe */
    if (is_file("./vistas/" . $_GET['vista'] . ".php") && $_GET['vista'] != "404") {

        /* Si es login y la sesión está activa, redirige al dashboard */
        if ($_GET['vista'] == "login" && isset($_SESSION['id'])) {
            switch ($_SESSION['rol']) {
                case 1: // Admin
                    header("Location: index.php?vista=admin_dashboard");
                    break;
                case 2: // encargado de area
                    header("Location: index.php?vista=encargadoarea_dashboard");
                    break;
                case 3: // finanzas
                    header("Location: index.php?vista=finanzas_dashboard");
                    break;
                case 3: // gerente de finanzas
                    header("Location: index.php?vista=gerentefinanzas_dashboard");
                    break;
                default:
                    session_destroy();
                    header("Location: index.php?vista=login");
                    exit();
            }
            exit();
        }

        /* Si la sesión está activa, mostrar navbar y vistas protegidas */
        if ($_GET['vista'] != "login") {
            /* Validar acceso según el rol */
            $permitido = false;

            // Lista de páginas por rol
            $rutas_roles = [
                1 => ['admin_dashboard'],
                2 => ['encargadoarea_dashboard'],
                3 => ['finanzas_dashboard'],
                4 => ['gerentefinanzas_dashboard'],
            ];

            // Validar si el rol tiene acceso a la página
            if (isset($rutas_roles[$_SESSION['rol_id']]) && in_array($_GET['vista'], $rutas_roles[$_SESSION['rol_id']])) {
                $permitido = true;
            }

            if (!$permitido) {
                include "./vistas/404.php"; // Página no permitida
                exit();
            }

            /* Mostrar el contenido si está permitido */
            include "./inc/navbar.php";
            include "./vistas/" . $_GET['vista'] . ".php";
            include "./inc/script.php";
        } else {
            include "./vistas/login.php";
        }
    } else {
        /* Página no encontrada */
        include "./vistas/404.php";
    }

    ob_end_flush();
    ?>
</body>
</html>