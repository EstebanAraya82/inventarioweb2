<?php
// Incluir la librería de PhpSpreadsheet
require 'vendor/autoload.php'; // Asegúrate de que esta ruta apunte correctamente a tu archivo autoload.php de Composer

// Conexión a la base de datos
require_once './main.php';

// Cargar la librería de PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Crear una nueva instancia de Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Establecer el título y los encabezados de las columnas
$sheet->setCellValue('A1', 'ID Activo');
$sheet->setCellValue('B1', 'Nombre');
$sheet->setCellValue('C1', 'Categoria');
$sheet->setCellValue('D1', 'Piso');
$sheet->setCellValue('E1', 'Posicion');

// Realizar la consulta para obtener los datos de los activos
$query = "SELECT * FROM activos";  // Ajusta esta consulta según tus necesidades
$resultado = mysqli_query($conn, $query);

// Si la consulta devuelve resultados, rellenamos el archivo Excel con los datos
if ($resultado && mysqli_num_rows($resultado) > 0) {
    $rowIndex = 2; // Comenzamos desde la fila 2, ya que la fila 1 tiene los encabezados

    // Iterar sobre los resultados y escribir cada fila en el archivo Excel
    while ($row = mysqli_fetch_assoc($resultado)) {
        $sheet->setCellValue('A' . $rowIndex, $row['id']); // Suponiendo que tienes una columna 'id' en la base de datos
        $sheet->setCellValue('B' . $rowIndex, $row['nombre']);
        $sheet->setCellValue('C' . $rowIndex, $row['categoria']);
        $sheet->setCellValue('D' . $rowIndex, $row['piso']);
        $sheet->setCellValue('E' . $rowIndex, $row['posicion']);
        $rowIndex++;
    }
} else {
    echo 'No hay datos para generar el reporte.';
}

// Establecer los encabezados HTTP para la descarga del archivo Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporte_activos.xlsx"');
header('Cache-Control: max-age=0');

// Crear el escritor y enviar el archivo al navegador
$writer->save('php://output');

// Cerrar la conexión a la base de datos
mysqli_close($conn);
