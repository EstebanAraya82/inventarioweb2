<div class="container is-fluid mb-6">
    <h1 class="title">Estados</h1>
    <h2 class="subtitle">Lista de estados</h2>
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
        $url="index.php?vista=statusasset_list&page=";
        $registros=10;
        $busqueda="";

        /* Paginador estado activo */
        require_once "./php/estadoactivo_listar.php";
    ?>
</div>