<div class="container is-fluid mb-6">
    <h1 class="title">Usuario</h1>
    <h2 class="subtitle">Lista de usuarios</h2>
</div>

<div class="container pb-12 pt-12">  
    <?php
        include "./inc/btn_atras.php";
        require_once "./php/main.php";

       /* Eliminar usuario */
        if(isset($_GET['user_id_del'])){
            require_once "./php/usuario_eliminar.php";
        }

        if(!isset($_GET['page'])){
            $pagina=1;
        }else{
            $pagina=(int) $_GET['page'];
            if($pagina<=1){
                $pagina=1;
            }
        }

        $area_id=(isset($_GET['area_id'])) ?  $_GET['area_id'] : 0;
        $rol_id=(isset($_GET['rol_id'])) ?  $_GET['rol_id'] : 0;
        $estadousuario_id=(isset($_GET['estadousuario_id'])) ?  $_GET['estadousuario_id'] : 0;
        $pagina=limpiar_cadena($pagina);
        $url="index.php?vista=user_list&page=";
        $registros=10;
        $busqueda="";

        /* Paginador usuario */
        require_once "./php/usuario_listar.php";
    ?>
</div>                                          