<div class="container is-fluid mb-6">
    <h1 class="title">Solicitud baja activo</h1>
    <h2 class="subtitle">Nueva Solicitud</h2>
</div>

<div class="container pb-6 pt-6">
    <?php
    include "./inc/btn_atras.php";
    require_once "./php/main.php";
    ?>


    <div class="container pb-10 pt-10">
        <div class="form-rest mb-6 mt-6"></div>

        <form action="./php/bajaactivo_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Nombre solicitante</label>
                        <input class="input" type="text" name="usuario_nombre" placeholder="Ingrese nombre"
                            pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" required
                            value="<?php echo isset($_SESSION['usuario_nombre']) ? $_SESSION['usuario_nombre'] : ''; ?>">
                    </div>
                </div>
                <div class="column">
                    <div class="control">
                        <label>Nombre solicitante</label>
                        <input class="input" type="text" name="usuario_apellido" placeholder="Ingrese apellido"
                            pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" required
                            value="<?php echo isset($_SESSION['usuario_apellido']) ? $_SESSION['usuario_apellido'] : ''; ?>">
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <label>Codigo activo</label><br>
                    <div class="select is-rounded">
                        <select name="solicitudbaja_activo">
                            <option value="" selected="">Seleccione una opción</option>
                            <?php
                            $activo = conexion();
                            $activo = $activo->query("SELECT * From activo");
                            if ($activo->rowCount() > 0) {
                                $activo = $activo->fetchAll();
                                foreach ($activo as $row) {
                                    echo '<option value="' . $row['activo_id'] . '" >' . $row['activo_codigo'] . '</option>';
                                }
                            }
                            $activo = null;
                            ?>
                        </select>
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
                        <input class="input" type="text" name="solicitud_codigo" pattern="[0-9]{3,50}" maxlength="50" required>
                    </div>
                </div>
            </div>
           
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
                        <select name="solicitudbaja_estadosolicitud">
                            <option value="" selected="">Seleccione una opción</option>
                            <?php
                            $estadosol = conexion();
                            $estadosol = $estadosol->query("SELECT * From estadosolicitud");
                            if ($estadosol->rowCount() > 0) {
                                $estadosol = $estadosol->fetchAll();
                                foreach ($estadosol as $row) {
                                    echo '<option value="' . $row['estadosolicitud_id'] . '" >' . $row['estadosolicitud_nombre'] . '</option>';
                                }
                            }
                            $estadosol = null;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="column">
                    <label>Tipo baja</label><br>
                    <div class="select is-rounded">
                        <select name="solicitudbaja_tipobaja">
                            <option value="" selected="">Seleccione una opción</option>
                            <?php
                            $tipo = conexion();
                            $tipo = $tipo->query("SELECT * From tipobaja");
                            if ($tipo->rowCount() > 0) {
                                $tipo = $tipo->fetchAll();
                                foreach ($tipo as $row) {
                                    echo '<option value="' . $row['tipobaja_id'] . '" >' . $row['tipobaja_nombre'] . '</option>';
                                }
                            }
                            $tipo = null;
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

            <form action="/ruta-del-backend" method="POST" enctype="multipart/form-data">
                <div class="columns is-centered">
                    <div class="column is-half has-text-centered">
                        <label class="label">Adjuntar documento para la baja de activo</label>
                        <div class="file has-name is-centered is-primary">
                            <label class="file-label">
                                <input class="file-input" type="file" name="documento" id="documento" />
                                <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="file-label">Elija un archivo…</span>
                                </span>
                                <span class="file-name" id="file-name">No se ha subido ningún archivo</span>
                            </label>
                        </div>
                



            </form>

            <script>
                // Mostrar el nombre del archivo seleccionado
                const fileInput = document.getElementById("documento");
                const fileName = document.getElementById("file-name");

                fileInput.addEventListener("change", function() {
                    const file = fileInput.files[0];
                    if (file) {
                        fileName.textContent = file.name;
                    } else {
                        fileName.textContent = "No se ha subido ningún archivo";
                    }
                });
            </script>
                </div>
                </div>


            <p class="has-text-centered">
                <button type="submit" class="button is-info is-rounded">Guardar</button>
            </p>
        </form>
    </div>