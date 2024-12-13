<?php
/* session_start(); 
if (!isset($_SESSION['usuario_nombre']) || !isset($_SESSION['usuario_apellido'])) {
    echo "Error: No hay usuario iniciado.";
    exit;
} */
require_once "./php/main.php";
?>

<div class="container is-fluid mb-6">
    <h1 class="title">Solicitud baja activo</h1>
    <h2 class="subtitle">Nueva Solicitud</h2>
</div>

<div class="container pb-6 pt-6">
    <div class="form-rest mb-6 mt-6"></div>

    <form action="./php/bajaactivo_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Nombre solicitante</label>
                    <input class="input" type="text" name="usuario_nombre" value="<?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?>" readonly>
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Apellido solicitante</label>
                    <input class="input" type="text" name="usuario_apellido" value="<?php echo htmlspecialchars($_SESSION['usuario_apellido']); ?>" readonly>
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Código activo</label>
                    <input class="input" type="text" name="codigo_id" pattern="[0-9]{3,50}" placeholder="Ingrese el codigo del activo" maxlength="50" required>
                </div>
            </div>
               <div class="column">
                <div class="control">
                    <label>Fecha de solicitud</label>
                    <input class="input" type="date" name="fecha_solicitud" placeholder="Ingrese fecha" required>
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Código solicitud</label>
                    <input class="input" type="text" name="solicitud_codigo" id="codigosolicitud" pattern="[0-9]{3,50}" maxlength="50" required readonly>
                </div>
            </div>
            </div>
            <script>
                /* Función para generar un número aleatorio dígitos */
                function generarCodigo() {

                    /* Número entre 1 y 999999 */
                    return Math.floor(1 + Math.random() * 900000); 
                }

                /* Asignar el número generado al campo de entrada */
                document.getElementById('codigoActivo').value = generarCodigo();
            </script>
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Nombre aprobador</label>
                    <input class="input" type="text" name="aprobador_nombre" placeholder="Ingrese nombre aprobador"
                        pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" required>
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Apellido aprobador</label>
                    <input class="input" type="text" name="aprobador_apellido" placeholder="Ingrese apellido aprobador"
                        pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" required>
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <label>Estado solicitud</label><br>
                <div class="select is-rounded">
                    <select name="solicitud_estado" required>
                        <option value="" selected>Seleccione una opción</option>
                        <?php
                        $estadosol = conexion();
                        $estadosol = $estadosol->query("SELECT DISTINCT solicitud_estado FROM solicitudbaja");
                        if ($estadosol->rowCount() > 0) {
                            $estadosol = $estadosol->fetchAll();
                            foreach ($estadosol as $row) {
                                echo '<option value="' . htmlspecialchars($row['solicitud_estado']) . '">' . htmlspecialchars($row['solicitud_estado']) . '</option>';
                            }
                        }
                        $estadosol = null;
                        ?>
                    </select>
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Fecha de aprobación</label>
                    <input class="input" type="date" name="fecha_aprobacion" placeholder="Ingrese fecha" required>
                </div>
            </div>
        </div>

        <div class="columns is-centered">
            <div class="column is-half">
                <div class="control">
                    <label class="label has-text-centered">Observaciones</label>
                    <textarea class="textarea" name="motivo" placeholder="Ingrese observaciones relacionadas a la solicitud" rows="4"></textarea>
                </div>
            </div>
        </div>

        <div class="columns is-centered">
            <div class="column is-half has-text-centered">
                <label class="label">Adjuntar documento para la baja de activo</label>
                <div class="file has-name is-centered is-primary">
                    <label class="file-label">
                        <input class="file-input" type="file" name="documento" />
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label"> Elija un archivo… </span>
                        </span>
                        <span class="file-name"> No se ha subido ningún archivo </span>
                    </label>
                </div>
            </div>
        </div>

        <p class="has-text-centered">
            <button type="submit" class="button is-info is-rounded">Guardar</button>
        </p>
    </form>
</div>