<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Solo inicia la sesión si no está ya activa
}
if (!isset($_SESSION['id']) || $_SESSION['rol_id'] != 1) {
    header("Location: login.php"); // Si el usuario no está logueado o no es admin, lo redirige al login
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
</head>
<body>
    <!-- Incluir Navbar -->
    <?php include('navbar.php'); ?>

    <!-- Contenido principal -->
    <div class="main-content">
        <h3>Bienvenido, <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?></h3>
        <p>Desde aquí puedes administrar el sistema de inventario.</p>

       

    <style>
        /* Estilos básicos para el navbar */
        .navbar {
            background-color: #333;
            padding: 15px;
            color: white;
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-left a {
            font-size: 1.5em;
            color: white;
            text-decoration: none;
        }

        .navbar-right {
            display: flex;
        }

        .navbar-menu {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar-item {
            margin-left: 20px;
        }

        .navbar-item a {
            color: white;
            text-decoration: none;
            font-size: 1em;
        }

        .navbar-item a:hover {
            text-decoration: underline;
        }

        .main-content {
            padding: 20px;
        }

        .dashboard-options {
            display: flex;
            flex-direction: column;
        }

        .option {
            background-color: #f4f4f4;
            border-radius: 5px;
            margin: 10px 0;
            padding: 15px;
            text-align: center;
        }

        .option a {
            color: #333;
            font-size: 1.2em;
            text-decoration: none;
        }

        .option a:hover {
            text-decoration: underline;
        }

        /* Estilos para iconos */
        .fas {
            margin-right: 10px;
        }
    </style>
</body>
</html>
