<?php
/*== Almacenando datos ==*/
$usuario = limpiar_cadena($_POST['login_usuario']);
$clave = limpiar_cadena($_POST['login_clave']);

/*== Verificando campos obligatorios ==*/
if ($usuario == "" || $clave == "") {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            No has llenado todos los campos que son obligatorios
        </div>
    ';
    exit();
}

/*== Verificando integridad de los datos ==*/
if (verificar_datos("[a-zA-Z0-9@.]{4,50}", $usuario)) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            El USUARIO no coincide con el formato solicitado
        </div>
    ';
    exit();
}

if (verificar_datos("[a-zA-Z0-9$@.-]{7,50}", $clave)) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            Las CLAVE no coinciden con el formato solicitado
        </div>
    ';
    exit();
}

/*== Verificando el usuario en la base de datos ==*/
$check_user = conexion();
$check_user = $check_user->query("SELECT * FROM usuario WHERE usuario_usuario='$usuario' AND usuario_estado=1");

if ($check_user->rowCount() == 1) {
    $check_user = $check_user->fetch();

    /*== Verificando la clave ==*/
    if ($check_user['usuario_usuario'] == $usuario && password_verify($clave, $check_user['usuario_clave'])) {

        // Almacenamos la información del usuario en la sesión
        $_SESSION['id'] = $check_user['usuario_id'];
        $_SESSION['nombre'] = $check_user['usuario_nombre'];
        $_SESSION['apellido'] = $check_user['usuario_apellido'];
        $_SESSION['usuario'] = $check_user['usuario_usuario'];
        $_SESSION['rol_id'] = $check_user['rol_id'];

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
        exit();
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