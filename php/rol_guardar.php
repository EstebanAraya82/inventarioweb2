<?php
    require_once "main.php"; 

    /* Almacenar datos */
    $nombre=limpiar_cadena($_POST['rol_nombre']);

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
                El rol no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    /* Guardando datos */
    $guardar_rol=conexion();
    $guardar_rol=$guardar_rol->prepare("INSERT INTO rol(rol_nombre) VALUES(:nombre)");

    $marcadores=[
        ":nombre"=>$nombre
       
    ];

    $guardar_rol->execute($marcadores);

    if($guardar_rol->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡Usuario Registrado!</strong><br>
                El rol se registro correctamente
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No se pudo registrar el rol, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_rol=null;