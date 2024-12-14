<?php
	/* require_once "../inc/inicio_sesion.php"; */

	require_once "main.php";

    /* Almacenamiento id */
    $id=limpiar_cadena($_POST['usuario_id']);

    /* Verificación usuario */
	$check_usuario=conexion();
	$check_usuario=$check_usuario->query("SELECT * FROM usuario WHERE usuario_id='$id'");

    if($check_usuario->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El usuario no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_usuario->fetch();
    }
    $check_usuario=null;

   /* Almacenando datos del usuario */
   $nombre=limpiar_cadena($_POST['usuario_nombre']);
   $apellido=limpiar_cadena($_POST['usuario_apellido']);
   $usuario=limpiar_cadena($_POST['usuario_usuario']);
   $correo=limpiar_cadena($_POST['usuario_correo']);
   $clave_1=limpiar_cadena($_POST['usuario_clave_1']);
   $clave_2=limpiar_cadena($_POST['usuario_clave_2']);   
   $usuarioestado=limpiar_cadena($_POST['usuario_estado']);
   $area=limpiar_cadena($_POST['usuario_area']);
   $rol=limpiar_cadena($_POST['usuario_rol']);
   


    /* Verificando campos obligatorios del usuario */
     if($nombre=="" || $apellido=="" || $usuario=="" || $usuarioestado=="" || $area="" || $rol=""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /* Verificando integridad de los datos (usuario) */
    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El nombre no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}",$apellido)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El apellido no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9@.]{4,50}",$usuario)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El usuario no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

        /* Verificando correo */
        if($correo!="" && $correo!=$datos['usuario_correo']){
            if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
                $check_correo=conexion();
                $check_correo=$check_correo->query("SELECT usuario_correo FROM usuario WHERE usuario_correo='$correo'");
                if($check_correo->rowCount()>0){
                    echo '
                        <div class="notification is-danger is-light">
                            <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                            El correo electrónico ingresado ya se encuentra registrado, por favor elija otro
                        </div>
                    ';
                    exit();
                }
                $check_correo=null;
            }else{
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                        Ha ingresado un correo electrónico no valido
                    </div>
                ';
                exit();
            } 
        }

    /* Verificando usuario */
    if($usuario!=$datos['usuario_usuario']){
	    $check_usuario=conexion();
	    $check_usuario=$check_usuario->query("SELECT usuario_usuario FROM usuario WHERE usuario_usuario='$usuario'");
	    if($check_usuario->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                El usuario ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_usuario=null;
    }


    /* Verificando claves */
    if($clave_1!="" || $clave_2!=""){
    	if(verificar_datos("[a-zA-Z0-9$@.-]{7,50}",$clave_1) || verificar_datos("[a-zA-Z0-9$@.-]{7,50}",$clave_2)){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                Las claves no coinciden con el formato solicitado
	            </div>
	        ';
	        exit();
	    }else{
		    if($clave_1!=$clave_2){
		        echo '
		            <div class="notification is-danger is-light">
		                <strong>¡Lo sentimos,currio un error inesperado!</strong><br>
		                Las contrase oñas que ha ingresado no coinciden
		            </div>
		        ';
		        exit();
		    }else{
		        $clave=password_hash($clave_1,PASSWORD_BCRYPT,["cost"=>10]);
		    }
	    }
    }else{
    	$clave=$datos['usuario_clave'];
    }

     /* Verificando usuario */
     if($usuario!=$datos['usuario_usuario']){
	    $check_usuario=conexion();
	    $check_usuario=$check_usuario->query("SELECT usuario_usuario FROM usuario WHERE usuario_usuario='$usuario'");
	    if($check_usuario->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                El usuario ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_usuario=null;
    }

     /* Verificando estado */
     if($usuarioestado!=$datos['usuario_estado']){
	    $check_usuarioestado=conexion();
	    $check_usuarioestado=$check_usuarioestado->query("SELECT usuario_estado FROM usuario WHERE usuario_estado='$usuarioestado'");
	    if($check_usuarioestado->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                El estado ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_usuarioestado=null;
    }

   /* Verificando área */
    if($area!=$datos['area_id']){
	    $check_area=conexion();
	    $check_area=$check_area->query("SELECT area_id FROM area WHERE area_id='$area'");
	    if($check_area->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                El area ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_area=null;
    }

     /* Verificando rol */
     if($rol!=$datos['rol_id']){
	    $check_rol=conexion();
	    $check_rol=$check_rol->query("SELECT rol_id FROM rol WHERE rol_id='$rol'");
	    if($check_rol->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                El rol ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_rol=null;
    }



    /* Actualizar datos */
    $actualizar_usuario=conexion();
    $actualizar_usuario=$actualizar_usuario->prepare("UPDATE usuario SET usuario_nombre=:nombre,usuario_apellido=:apellido,
    usuario_usuario=:usuario,usuario_correo=:correo,usuario_clave=:clave,usuario_estado=:usuarioestado,area_id=area,rol_id=rol WHERE usuario_id=:id");

    $marcadores=[
        ":nombre"=>$nombre,
        ":apellido"=>$apellido,
        ":usuario"=>$usuario,
        ":correo"=>$correo,
        ":clave"=>$clave,
        ":usuarioestado"=>$usuarioestado,
        ":area"=>$area,
        ":rol"=>$rol,
        ":id"=>$id
    ];

    if($actualizar_usuario->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡Usuario actualizado!</strong><br>
                El usuario se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el usuario, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_usuario=null;