<?php
    require_once "main.php"; 

    /* Almacenar datos */
    $nombre=limpiar_cadena($_POST['sector_nombre']);

    /* Verificar campos obligatorios */
    if($nombre=="" ){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /* Verificar integridad de los datos */
    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El sector no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    /* Guardando datos */
    $guardar_sector=conexion();
    $guardar_sector=$guardar_sector->prepare("INSERT INTO sector (sector_nombre) VALUES(:nombre)");

    $marcadores=[
        ":nombre"=>$nombre
       
    ];

    $guardar_sector->execute($marcadores);

    if($guardar_sector->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡Usuario Registrado!</strong><br>
                El sector se registro correctamente
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No se pudo registrar el sector, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_sector=null;