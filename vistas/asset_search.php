<div class="container is-fluid mb-6">
    <h1 class="title">Activos</h1>
    <h2 class="subtitle">Buscar Activo</h2>
</div>

<div class="container pb-6 pt-6">
    <?php
    include "./inc/btn_atras.php";
    require_once "./php/main.php";

    if (isset($_POST['modulo_buscador'])) {
        require_once "./php/buscador.php";
    }

    if (!isset($_SESSION['busqueda_activo']) && empty($_SESSION['busqueda_activo'])) {
    ?>
        <div class="columns">
            <div class="column">
                <form action="" method="POST" autocomplete="off">
                    <input type="hidden" name="modulo_buscador" value="activo">
                    <div class="field is-grouped">
                        <p class="control is-expanded">
                            <input class="input is-rounded" type="text" name="txt_buscador" placeholder="¿Qué estas buscando?"
                                pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ@.]{1,30}" maxlength="30">
                        </p>
                        <p class="control">
                            <button class="button is-info" type="submit">Buscar</button>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    <?php } else { ?>
        <div class="columns">
            <div class="column">
                <form class="has-text-centered mt-6 mb-6" action="" method="POST" autocomplete="off">
                    <input type="hidden" name="modulo_buscador" value="activo">
                    <input type="hidden" name="eliminar_buscador" value="activo">
                    <p>Estas buscando <strong>“<?php echo $_SESSION['busqueda_activo']; ?>”</strong></p>
                    <br>
                    <button type="submit" class="button is-danger is-rounded">Eliminar busqueda</button>
                </form>
            </div>
        </div>
    <?php
       
        if (!isset($_GET['page'])) {
            $pagina = 1;
        } else {
            $pagina = (int) $_GET['page'];
            if ($pagina <= 1) {
                $pagina = 1;
            }
        }

        $categoria_id = (isset($_GET['categoria_id'])) ? $_GET['categoria_id'] : 0;
        $piso_id = (isset($_GET['piso_id'])) ? $_GET['piso_id'] : 0;
        $posicion_id = (isset($_GET['posicion_id'])) ? $_GET['posicion_id'] : 0;
        $area_id = (isset($_GET['area_id'])) ? $_GET['area_id'] : 0;
        $sector_id = (isset($_GET['sector_id'])) ? $_GET['sector_id'] : 0;
        $estadoactivo_id = (isset($_GET['estadoactivo_id'])) ? $_GET['estadoactivo_id'] : 0;

        $pagina = limpiar_cadena($pagina);
        $url = "index.php?vista=asset_search&page=";
        $registros = 5;
        $busqueda = $_SESSION['busqueda_activo'];

        /* Paginador activo */
        require_once "./php/activo_listar.php";
    }
    ?>
</div>