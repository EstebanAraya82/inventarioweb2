<div class="container is-fluid mb-6">
    <h1 class="title">Área</h1>
    <h2 class="subtitle">Lista de áreas</h2>
</div>

<div class="container pb-12 pt-12">  
    <?php
        include "./inc/btn_atras.php";
        require_once "./php/main.php";

      if(!isset($_GET['page'])){
            $pagina=1;
        }else{
            $pagina=(int) $_GET['page'];
            if($pagina<=1){
                $pagina=1;
            }
        }

        $pagina=limpiar_cadena($pagina);
        $url="index.php?vista=area_list&page=";
        $registros=5;
        $busqueda="";

        /* Paginador area */
        require_once "./php/area_listar.php";
    ?>
</div>