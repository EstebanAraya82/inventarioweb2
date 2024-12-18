<?php
/*== Almacenando datos ==*/
$usuario = limpiar_cadena($_POST['login_usuario']);
$clave = limpiar_cadena($_POST['login_clave']);

/*== Verificando campos obligatorios ==*/
if($usuario == "" || $clave == ""){
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            No has llenado todos los campos que son obligatorios
        </div>
    ';
    exit();
}

/*== Verificando integridad de los datos ==*/
if(verificar_datos("[a-zA-Z0-9@.]{4,50}",$usuario)){
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            El USUARIO no coincide con el formato solicitado
        </div>
    ';
    exit();
}

if(verificar_datos("[a-zA-Z0-9$@.-]{7,50}",$clave)){
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            Las CLAVE no coinciden con el formato solicitado
        </div>
    ';
    exit();
}

$check_user = conexion();
$check_user = $check_user->query("SELECT u.*, r.rol_nombre FROM usuario u INNER JOIN rol r ON u.rol_id = r.rol_id WHERE u.usuario_usuario = '$usuario'");

if($check_user->rowCount() == 1){
    $check_user = $check_user->fetch();

    // Verificar si el usuario está activo
    if($check_user['estadousuario_id'] == 0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Cuenta desactivada!</strong><br>
                Tu cuenta está inactiva. Contacta al administrador.
            </div>
        ';
        exit();
    }

    // Verificar si el usuario y la clave coinciden
    if($check_user['usuario_usuario'] == $usuario && password_verify($clave, $check_user['usuario_clave'])){
        // Establecer variables de sesión
        $_SESSION['id'] = $check_user['usuario_id'];
        $_SESSION['nombre'] = $check_user['usuario_nombre'];
        $_SESSION['apellido'] = $check_user['usuario_apellido'];
        $_SESSION['usuario'] = $check_user['usuario_usuario'];
        $_SESSION['rol_id'] = $check_user['rol_id']; // Guardamos el rol
        $_SESSION['estado'] = $check_user['usuario_estado']; // Estado del usuario

        // Redirigir según el rol
        
        switch ($_SESSION['rol_id']) {
            case 1: // Rol de admin
                header("Location: index.php?vista=admin_dashboard");
                break;
            case 2: // Rol de encargado de area
                header("Location: index.php?vista=encargadoarea_dashboard");
                break;
            case 3: // Rol de finanzas
                header("Location: index.php?vista=finanzas_dashboard");
                break;
            case 4: // Rol de gerente de finanzas
                header("Location: index.php?vista=gerentefinanzas_dashboard");
                break;
            default:
                header("Location: index.php?vista=home");
                break;
        }

    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Usuario o clave incorrectos
            </div>
        ';
    }
} else {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            Usuario o clave incorrectos
        </div>
    ';
}

$check_user = null;
?>
