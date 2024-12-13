<?php
	require_once "main.php";

	/* Almacenando id */
    $id=limpiar_cadena($_POST['piso_id']);


    /* Verificando piso */
	$check_piso=conexion();
	$check_piso=$check_piso->query("SELECT * From piso Where piso_id='$id'");

    if($check_piso->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El piso no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_piso->fetch();
    }
    $check_piso=null;

    /* Almacenando datos */
    $numero=limpiar_cadena($_POST['piso_numero']);
    


    /* Verificando campos obligatorios */
    if($numero==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /* Verificando integridad de los datos */
    if(verificar_datos("[0-9-]{3,50}",$numero)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El piso no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    
    /* Verificando número */
    if($numero!=$datos['piso_numero']){
	    $check_numero=conexion();
	    $check_numero=$check_numero->query("SELECT piso_numero From piso Where piso_numero='$numero'");
	    if($check_numero->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                El piso ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_numero=null;
    }


    /* Actualizar datos */
    $actualizar_piso=conexion();
    $actualizar_piso=$actualizar_piso->prepare("UPDATE piso Set piso_numero=:numero Where piso_id=:id");

    $marcadores=[
        ":numero"=>$numero,
        ":id"=>$id
    ];

    if($actualizar_piso->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡Categoria Actualizada!</strong><br>
                El piso se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el piso, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_piso=null;