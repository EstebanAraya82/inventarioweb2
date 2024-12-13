<?php
ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Inicia la sesión solo si no hay una sesión activa
}

$modulo_buscador = limpiar_cadena($_POST['modulo_buscador']);

$modulos = ["usuario",  "activo",  "categoria", "piso", "posicion", "area", "sector"];

if (in_array($modulo_buscador, $modulos)) {

    $modulos_url = [
        "usuario" => "user_search",
        "activo" => "asset_search",
        "categoria" => "category_search",
        "piso" => "floor_search",
        "posicion" => "position_search",
        "area" => "area_search",
        "sector" => "sector_search"
    ];

    $modulos_url = $modulos_url[$modulo_buscador];
    $modulo_buscador = "busqueda_" . $modulo_buscador;

    $mensaje = null;

    /* Iniciar busqueda */
    if (isset($_POST['txt_buscador'])) {
        $txt = limpiar_cadena($_POST['txt_buscador']);

        if ($txt == "") {
            $mensaje = '
                <div class="notification is-danger is-light">
                    <strong>¡Lo sentimos, ocurrió un error inesperado!</strong><br>
                    Introduce el término de búsqueda
                </div>
            ';
        } else {
            if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ@.]{1,30}", $txt)) {
                $mensaje = '
                    <div class="notification is-danger is-light">
                        <strong>¡Lo sentimos, ocurrió un error inesperado!</strong><br>
                        El término de búsqueda no coincide con el formato solicitado
                    </div>
                ';
            } else {
                $_SESSION[$modulo_buscador] = $txt;
                header("Location: index.php?vista=$modulos_url", true, 303);
                exit();
            }
        }
    }

    /* Eliminar busqueda */
    if (isset($_POST['eliminar_buscador'])) {
        unset($_SESSION[$modulo_buscador]);
        header("Location: index.php?vista=$modulos_url", true, 303);
        exit();
    }

    if ($mensaje) {
        echo $mensaje;
    }
} else {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Lo sentimos, ocurrió un error inesperado!</strong><br>
            No podemos procesar la solicitud
        </div>
    ';
}
ob_end_flush();
