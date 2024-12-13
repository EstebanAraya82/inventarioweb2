<?php
    require_once "main.php"; 

    /* Almacenar datos */
    $numero=limpiar_cadena($_POST['piso_numero']);

    /* Verificar campos obligatorios */
    if($numero=="" ){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /* Verificar integridad de los datos */
    if(verificar_datos("[0-9-]{1,50}",$numero)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El piso no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    /* Guardando datos */
    $guardar_piso=conexion();
    $guardar_piso=$guardar_piso->prepare("INSERT INTO piso (piso_numero) VALUES(:numero)");

    $marcadores=[
        ":numero"=>$numero
       
    ];

    $guardar_piso->execute($marcadores);

    if($guardar_piso->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡Usuario Registrado!</strong><br>
                El piso se registro correctamente
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No se pudo registrar el piso, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_piso=null;