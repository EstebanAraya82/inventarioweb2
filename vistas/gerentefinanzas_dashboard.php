<?php
session_start();
if ($_SESSION['rol'] != 4) { // Verifica si el usuario es gerente de finanzas
    header("Location: index.php");
    exit();
}
?>

<!-- Incluir el navbar -->
<?php include "navbar.php"; ?>
<div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">

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

<section class="section">
    <div class="container">
        <h1 class="title">Bienvenido, <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?>!</h1>
        <p>Este es tu panel principal.</p>
    </div>
</section>