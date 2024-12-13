<?php
session_start();
if ($_SESSION['rol'] != 2) { // Verifica si el usuario es encargado de área
    header("Location: index.php");
    exit();
}
?>

<!-- Incluir el navbar -->
<?php include "navbar.php"; ?>
<div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">

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
                    <a class="navbar-item" href="index.php?vista=position_new"> Nueva posición</a>
                    <a class="navbar-item" href="index.php?vista=position_list">Listar posiciones</a>
                    <a class="navbar-item" href="index.php?vista=position_search">Buscar posición</a>
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

<section class="section">
    <div class="container">
        <h1 class="title">Bienvenido, <?php echo $_SESSION['nombre']." ".$_SESSION['apellido']; ?>!</h1>
        <p>Este es tu panel principal.</p>
    </div>
</section>