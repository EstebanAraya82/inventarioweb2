<div class="container is-fluid mb-6">
    <h1 class="title">Roles</h1>
    <h2 class="subtitle">Lista de roles</h2>
</div>

<div class="container pb-6 pt-6">  
    <?php
        include "./inc/btn_atras.php";
        require_once "./php/main.php";

         /* Eliminar rol */
         if(isset($_GET['role_id_del'])){
            require_once "./php/rol_eliminar.php";
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
        $url="index.php?vista=role_list&page=";
        $registros=6;
        $busqueda="";

        /* Paginador rol */
        require_once "./php/rol_listar.php";
    ?>
</div>