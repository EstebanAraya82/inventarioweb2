<?php
// Iniciar la sesión si aún no está activa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario no está logueado o si el rol es de administrador (rol_id == 1), redirigir a login
if (!isset($_SESSION['id']) || $_SESSION['rol_id'] == 1) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

</head>

<body>


    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="index.php?vista=finanzas_dashboard">
                <img src="./img/logo.png" width="60" height="28" alt="Logo">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">

                <!-- Menú de solicitud de baja de activos -->
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">Solicitud de baja</a>
                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="index.php?vista=assetderegistration_list">Lista de solicitudes</a>
                        <a class="navbar-item" href="index.php?vista=assetderegistration_search">Buscar solicitud</a>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <a href="index.php?vista=logout" class="button is-link is-rounded">Salir</a>
    </nav>

    <!-- Contenido principal -->
    <div class="main-content">
        <h3 class="title is-3">Bienvenido, <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?></h3>
        <p class="is-size-4">Este es tu panel</p>
    </div>

</body>

</html>