<div class="container is-fluid mb-6">
    <h1 class="title">Sector</h1>
    <h2 class="subtitle">Lista de sectores</h2>
</div>

<div class="container pb-12 pt-12">  
    <?php
        include "./inc/btn_atras.php";
        require_once "./php/main.php";

         /* Eliminar sector */
         if(isset($_GET['sector_id_del'])){
            require_once "./php/sector_eliminar.php";
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
        $url="index.php?vista=sector_list&page=";
        $registros=5;
        $busqueda="";

        /* Paginador sector */
        require_once "./php/sector_listar.php";
    ?>
</div>