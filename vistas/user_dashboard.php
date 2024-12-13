<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>
</head>
<body>
    <h1>Bienvenido, Usuario</h1>
    <p>Este es el panel para usuarios.</p>
</body>
</html>
