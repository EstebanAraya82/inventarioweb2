<div class="container is-fluid mb-6">
    <h1 class="title">Solicitudes</h1>
    <h2 class="subtitle">Lista de solicitudes</h2>
</div>

<div class="container pb-12 pt-12">
    <?php
    include "./inc/btn_atras.php";
    require_once "./php/main.php";

    if (!isset($_GET['page'])) {
        $pagina = 1;
    } else {
        $pagina = (int) $_GET['page'];
        if ($pagina <= 1) {
            $pagina = 1;
        }
    }

    $activo_id = (isset($_GET['activo_id'])) ?  $_GET['activo_id'] : 0;



    $pagina = limpiar_cadena($pagina);
    $url = "index.php?vista=assetderegistration_list&page=";
    $registros = 5;
    $busqueda = "";

    /* Paginador solicitud */
    require_once "./php/bajaactivo_listar.php";
    ?>
</div>