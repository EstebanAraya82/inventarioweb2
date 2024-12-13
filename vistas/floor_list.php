<div class="container is-fluid mb-6">
    <h1 class="title">Pisos</h1>
    <h2 class="subtitle">Lista de pisos</h2>
</div>

<div class="container pb-12 pt-12">  
    <?php
        include "./inc/btn_atras.php";
        require_once "./php/main.php";

         /* Eliminar piso */
         if(isset($_GET['floor_id_del'])){
            require_once "./php/piso_eliminar.php";
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
        $url="index.php?vista=floor_list&page=";
        $registros=5;
        $busqueda="";

        /* Paginador piso */
        require_once "./php/piso_listar.php";
    ?>
</div>