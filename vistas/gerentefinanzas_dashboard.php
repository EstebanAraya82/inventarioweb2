<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Solo inicia la sesión si no está ya activa
}
if (!isset($_SESSION['id']) || $_SESSION['rol_id'] == 1) {
    header("Location: login.php"); // Si el usuario no está logueado o es admin, lo redirige al login
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Usuario</title>
    <link rel="stylesheet" href="path_to_your_css_file.css"> <!-- Cambia esta ruta a tu archivo CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Para íconos de Font Awesome -->
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar">
    <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Solicitud de baja</a>    
               <div class="navbar-dropdown">
                    <a class="navbar-item" href="index.php?vista=assetderegistration_new"> Nueva solicitud</a>
                    <a class="navbar-item" href="index.php?vista=assetderegistration_list">Lista de solicitudes</a>
                    <a class="navbar-item" href="index.php?vista=assetderegistration_search">Buscar solicitud</a>
                   </div>               
            </div>  
             </nav>

    <!-- Contenido principal -->
    <div class="main-content">
        <h3>Bienvenido, <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?></h3>
        <p>Desde aquí puedes gestionar tus datos y consultar el inventario.</p>
     

   
</body>
</html>
