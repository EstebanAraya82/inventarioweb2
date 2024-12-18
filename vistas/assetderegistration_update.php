<div class="container is-fluid mb-12">
    <h1 class="title">Solicitudes</h1>
    <h2 class="subtitle">Actualizar solicitud</h2>
</div>

<div class="container pb-12 pt-12">

    <?php

    include "./inc/btn_atras.php";
    require_once "./php/main.php";

    $id = (isset($_GET['assetderegistration_id_up'])) ? $_GET['assetderegistration_id_up'] : 0;
    $id = limpiar_cadena($id);

    /* Verificar equipo */
    $check_solicitud = conexion();
    $check_solicitud = $check_solicitud->query("SELECT * FROM solicitudbaja WHERE solicitud_id='$id'");

    if ($check_solicitud->rowCount() > 0) {
        $datos = $check_solicitud->fetch();
    ?>

        <div class="form-rest mb-12 mt-12"></div>

        <form action="./php/bajaactivo_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off">

            <input type="hidden" name="solicitud_id" value="<?php echo $datos['solicitud_id']; ?>" required>

            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Nombre solicitante</label>
                        <input class="input" type="text" name="usuario_nombre" placeholder="Ingrese nombre"
                            pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50"
                            value="<?php echo $datos['solicitadornom']; ?>"
                            required >
                    </div>
                </div>
                <div class="column">
                    <div class="control">
                        <label>Apellido solicitante</label>
                        <input class="input" type="text" name="usuario_apellido" placeholder="Ingrese apellido"
                            pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50"
                            value="<?php echo $datos['solicitadorape']; ?>"
                            required >
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
                                    $selected = ($row['activo_id'] == $datos['activo_id']) ? 'selected' : '';
                                    echo '<option ' . $selected . ' value="' . $row['activo_id'] . '" >' . $row['activo_codigo'] . '</option>';
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
                        <input class="input" type="date" name="fecha_solicitud" placeholder="Ingrese fecha" value="<?php echo explode(" ", $datos['fecha_solicitud'])[0]; ?>" required >
                    </div>
                </div>
                <div class="column">
                    <div class="control">
                        <label>Código solicitud</label>
                        <input class="input" type="text" name="solicitud_codigo" pattern="[0-9]{3,50}" maxlength="50" required value="<?php echo $datos['solicitud_codigo']; ?>" >
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
                        <option value="<?php echo $datos['estadosolicitud_id']; ?>" selected="">Seleccione estado</option>
                            <?php
                            $estadosol = conexion();
                            $estadosol = $estadosol->query("SELECT * From estadosolicitud");
                            if ($estadosol->rowCount() > 0) {
                                $estadosol = $estadosol->fetchAll();
                                foreach ($estadosol as $row) {
                                    $selected = ($row['estadosolicitud_id'] == $datos['estadosolicitud_id']) ? 'selected': '';
                                    echo '<option ' . $selected . ' value="' . $row['estadosolicitud_id'] . '" >' . $row['estadosolicitud_nombre'] . '</option>';
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
                                    $selected = ($row['tipobaja_id'] == $datos['tipobaja_id']) ? 'selected': '';
                                    echo '<option ' . $selected . ' value="' . $row['tipobaja_id'] . '" >' . $row['tipobaja_nombre'] . '</option>';
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
                        <textarea class="textarea" name="motivo" placeholder="Ingrese observaciones relacionadas a la solicitud" rows="4">
                        <?php echo $datos['motivo']; ?>
                    </textarea>
                    </div>
                </div>
                <?php
                    if($datos['documento'] != ''){
                        echo '
                        <div>
                    <div class="columns is-centered">
                        <div class="column is-half has-text-centered">
                            <a href="documents/' . $datos['documento'] . '" target="_blank" rel="noopener noreferrer">
                            Presione aqui para ver el documento: ' . $datos['documento'] . '
                        </a>
                        </div>
                    </div>
                 </div>
                 ';
                    }
                ?>
                


                <!-- <form action="/ruta-del-backend" method="POST" enctype="multipart/form-data">
                
            </form> -->

                <!-- <script>
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
                </script> -->

                <p class="has-text-centered">
                    <button type="submit" class="button is-success is-rounded">Actualizar</button>
                </p>
        </form>
    <?php
    } else {
        include "./inc/alerta_error.php";
    }

    $check_solicitud = null;
    ?>
</div>