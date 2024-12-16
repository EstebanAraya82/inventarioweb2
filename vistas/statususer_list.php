<div class="container is-fluid mb-6">
    <h1 class="title">Estados</h1>
    <h2 class="subtitle">Lista de estados</h2>
</div>

<div class="container pb-12 pt-12">  
    <?php
        include "./inc/btn_atras.php";
        require_once "./php/main.php";

       /* Eliminar estado usuario */
        if(isset($_GET['statususer_id_del'])){
            require_once "./php/estadousuario_eliminar.php";
        }

        if(!isset($_GET['page'])){
            $pagina=1;
        }else{
            $pagina=(int) $_GET['page'];
            if($pagina<=1){
                $pagina=1;
            }
        }

        $pagina=limpiar_cadena($pagina);
        $url="index.php?vista=statususer_list&page=";
        $registros=10;
        $busqueda="";

        /* Paginador estado usuario */
        require_once "./php/estadousuario_listar.php";
    ?>
</div>