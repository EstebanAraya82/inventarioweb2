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
                <a class="navbar-link">Activos</a>    
               <div class="navbar-dropdown">
                    <a class="navbar-item" href="index.php?vista=asset_new"> Nuevo activo</a>
                    <a class="navbar-item" href="index.php?vista=asset_list">Listar activos</a>
                    <a class="navbar-item" href="index.php?vista=asset_search">Buscar activos</a>
                    <a class="navbar-item" href="index.php?vista=category_list">Categoria</a>
                   </div>               
            </div>    
             
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Piso</a>    
               <div class="navbar-dropdown">
                    <a class="navbar-item" href="index.php?vista=floor_new"> Nuevo piso</a>
                    <a class="navbar-item" href="index.php?vista=floor_list">Listar pisos</a>
                    <a class="navbar-item" href="index.php?vista=floor_search">Buscar piso</a>
                   </div>               
            </div>  
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Posición</a>    
               <div class="navbar-dropdown">
                    <a class="navbar-item" href="index.php?vista=position_new"> Nueva pisición</a>
                    <a class="navbar-item" href="index.php?vista=position_list">Listar posiciones</a>
                    <a class="navbar-item" href="index.php?vista=position_search">Buscar posición</a>
                   </div>               
            </div>  
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Área</a>    
               <div class="navbar-dropdown">
                    <a class="navbar-item" href="index.php?vista=area_new"> Nueva área</a>
                    <a class="navbar-item" href="index.php?vista=area_list">Listar áreas</a>
                    <a class="navbar-item" href="index.php?vista=area_search">Buscar área</a>
                   </div>               
            </div>  
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Sector</a>    
               <div class="navbar-dropdown">
                    <a class="navbar-item" href="index.php?vista=sector_new"> Nuevo sector</a>
                    <a class="navbar-item" href="index.php?vista=sector_list">Lista de sectores</a>
                    <a class="navbar-item" href="index.php?vista=sector_search">Buscar sector</a>
                   </div>               
            </div>                          
             <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Solicitud de baja</a>    
               <div class="navbar-dropdown">
                    <a class="navbar-item" href="index.php?vista=assetderegistration_new"> Nueva solicitud</a>
                    <a class="navbar-item" href="index.php?vista=assetderegistration_list">Lista de solicitudes</a>
                    <a class="navbar-item" href="index.php?vista=assetderegistration_search">Buscar solicitud</a>
                   </div>               
            </div>  
            </div> 
            </div> 
            </div> 
    </nav>

    <!-- Contenido principal -->
    <div class="main-content">
        <h3>Bienvenido, <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?></h3>
        <p>Desde aquí puedes gestionar tus datos y consultar el inventario.</p>
        
        <!-- Opciones del usuario -->
        <div class="dashboard-options">
            <div class="option">
                <a href="user_perfil.php"><i class="fas fa-user"></i> Ver Perfil</a>
            </div>
            <div class="option">
                <a href="user_inventario.php"><i class="fas fa-box"></i> Consultar Inventario</a>
            </div>
        </div>
    </div>

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