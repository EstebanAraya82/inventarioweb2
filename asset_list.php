<div class="container is-fluid mb-6">
    <h1 class="title">Activos</h1>
    <h2 class="subtitle">Lista de activos</h2>
</div>

<!-- Botón para generar el reporte -->
<div class="container pb-12 pt-12">
    <!-- <div class="control">
        <a href="./php/reporte_activos.php" class="button is-primary">Generar Reporte</a>
    </div> -->
    
    <?php
    include "./inc/btn_atras.php";
    require_once "./php/main.php";

    /* Eliminar activo 
        if(isset($_GET['asset_id_del'])){
            require_once "./php/activo_eliminar.php";
        } */

    if (!isset($_GET['page'])) {
        $pagina = 1;
    } else {
        $pagina = (int) $_GET['page'];
        if ($pagina <= 1) {
            $pagina = 1;
        }
    }

    $categoria_id = (isset($_GET['categoria_id'])) ?  $_GET['categoria_id'] : 0;
    $piso_id = (isset($_GET['piso_id'])) ?  $_GET['piso_id'] : 0;
    $posicion_id = (isset($_GET['posicion_id'])) ?  $_GET['posicion_id'] : 0;
    $area_id = (isset($_GET['area_id'])) ?  $_GET['area_id'] : 0;
    $sector_id = (isset($_GET['sector_id'])) ?  $_GET['sector_id'] : 0;
    $estadoactivo_id = (isset($_GET['estadoactivo_id'])) ?  $_GET['estadoactivo_id'] : 0;
    $pagina = limpiar_cadena($pagina);
    $url = "index.php?vista=asset_list&page=";
    $registros = 5;
    $busqueda = "";

    /* Paginador activo */
    require_once "./php/activo_listar.php";
    ?>
</div>
