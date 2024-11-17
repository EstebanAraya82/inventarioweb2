<?php
    require_once "main.php"; 

    /* Almacenar datos */
    $nombre=limpiar_cadena($_POST['usuario_nombre']);
    $apellido=limpiar_cadena($_POST['usuario_apellido']);
    $usuario=limpiar_cadena($_POST['usuario_usuario']);
    $correo=limpiar_cadena($_POST['usuario_correo']);
    $clave_1=limpiar_cadena($_POST['usuario_clave_1']);
    $clave_2=limpiar_cadena($_POST['usuario_clave_2']);
    $estado=limpiar_cadena($_POST['usuario_estado']);
    $rol=limpiar_cadena($_POST['usuario_rol']);
    


    /* Verificar campos obligatorios */
    if($nombre=="" || $apellido=="" || $usuario=="" || $clave_1=="" || $clave_2=="" || $estado=="" || $rol==""){
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

    if(verificar_datos("[a-zA-Z0-9$@.-*]{7,50}",$clave_1) || verificar_datos("[a-zA-Z0-9$@.-*]{7,50}",$clave_2)){
        echo '
            <div class="notification is-danger is-light">
               <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                La contraseñas no coinciden con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z]{4,50}",$estado)){
        echo '
            <div class="notification is-danger is-light">
               <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El estado no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z]{4,50}",$rol)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El estado no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

     /* Verificar correo */
     if($correo!=""){
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


    /* Verificar usuario */
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

     /* Verificar claves */
     if($clave_1!=$clave_2){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                Las contraseñas que ha ingresado no coinciden
            </div>
        ';
        exit();
    }else{
        $clave=password_hash($clave_1,PASSWORD_BCRYPT,["cost"=>10]);
    }

      /* verificar estado */
      $check_estado=conexion();
      $check_estado=$check_estado->query("SELECT estado_id FROM estado WHERE estado_id='$estado'");
      if($check_estado->rowCount()<=0){
          echo'
          <div class="notification is-danger is-light">
          <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                  El estado que ha ingresado no existe
              </div>
          ';
          exit();
      }

    /* verificar rol */
    $check_rol=conexion();
    $check_rol=$check_rol->query("SELECT rol_id FROM rol WHERE rol_id='$rol'");
    if($check_rol->rowCount()<=0){
        echo'
        <div class="notification is-danger is-light">
        <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El rol que ha ingresado no existe
            </div>
        ';
        exit();
    }

    /* Guardando datos */
    $guardar_usuario=conexion();
    $guardar_usuario=$guardar_usuario->prepare("INSERT INTO usuario(usuario_nombre,usuario_apellido,usuario_usuario,usuario_corrreo,
    usuario_clave,estado_id,rol_id) VALUES(:nombre,:apellido,:usuario,:correo,:clave,:estado,:rol)");

    $marcadores=[
        ":nombre"=>$nombre,
        ":apellido"=>$apellido,
        ":usuario"=>$usuario,
        ":correo"=>$correo,
        ":clave"=>$clave,
        ":estado"=> $estado,
        ":rol"=>$rol
    ];

    $guardar_usuario->execute($marcadores);

    if($guardar_usuario->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡Usuario Registrado!</strong><br>
                El usuario se registro correctamente
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No se pudo registrar el usuario, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_usuario=null;