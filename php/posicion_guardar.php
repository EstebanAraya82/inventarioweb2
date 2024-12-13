<?php
	require_once "main.php";

    /*== Almacenando datos ==*/
    $posicion=limpiar_cadena($_POST['posicion_posicion']);

    /* Verificando campos obligatorios */
    if($posicion==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[a-zA-Z0-9-]{2,50}",$posicion)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                La posición no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    /* Verificando posición */
    $check_posicion=conexion();
    $check_posicion=$check_posicion->query("SELECT posicion_posicion FROM posicion WHERE posicion_posicion='$posicion'");
    if($check_posicion->rowCount()>0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                La posicion ingresada ya se encuentra registrada, por favor elija otra
            </div>
        ';
        exit();
    }
    $check_posicion=null;


    /* Guardando datos */
    $guardar_posicion=conexion();
    $guardar_posicion=$guardar_posicion->prepare("INSERT INTO posicion (posicion_posicion) VALUES(:posicion)");

    $marcadores=[
        ":posicion"=>$posicion,
    ];

    $guardar_posicion->execute($marcadores);

    if($guardar_posicion->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡Categoria registrada exitosamente!</strong><br>
                La posición se registro con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No se pudo registrar la categoría, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_posicion=null;