<?php
require_once "./php/main.php";

// Definir el encabezado del archivo CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="reporte_activos.csv"');

// Abrir el archivo para escribir
$output = fopen('php://output', 'w');

// Escribir el encabezado del archivo CSV
fputcsv($output, ['ID', 'Nombre', 'Categoría', 'Piso', 'Área', 'Sector', 'Posición']);

// Obtener los datos de los activos (esto depende de cómo tengas organizada la base de datos)
$sql = "SELECT id, nombre, categoria, piso, area, sector, posicion FROM activos";
$result = mysqli_query($conn, $sql);

// Escribir los datos de cada activo en el archivo CSV
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

// Cerrar el archivo
fclose($output);
exit();
?>
