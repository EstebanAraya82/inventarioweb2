<div class="container is-fluid mb-6">
    <h1 class="title">Estados</h1>
    <h2 class="subtitle">Buscar estado</h2>
</div>

<div class="container pb-6 pt-6">
    <?php
        include "./inc/btn_atras.php";
        require_once "./php/main.php";

        if(isset($_POST['modulo_buscador'])){
            require_once "./php/buscador.php";
        }

        if(!isset($_SESSION['busqueda_estado']) && empty($_SESSION['busqueda_estado'])){
    ?>
    <div class="columns">
        <div class="column">
            <form action="" method="POST" autocomplete="off" >
                <input type="hidden" name="modulo_buscador" value="estadousuario">   
                <div class="field is-grouped">
                    <p class="control is-expanded">
                        <input class="input is-rounded" type="text" name="txt_buscador" placeholder="¿Qué estas buscando?" 
                        pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ@.]{1,30}" maxlength="30" >
                    </p>
                    <p class="control">
                        <button class="button is-info" type="submit" >Buscar</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <?php }else{ ?>
    <div class="columns">
        <div class="column">
            <form class="has-text-centered mt-6 mb-6" action="" method="POST" autocomplete="off" >
                <input type="hidden" name="modulo_buscador" value="estadousuario"> 
                <input type="hidden" name="eliminar_buscador" value="estadousuario">
                <p>Estas buscando <strong>“<?php echo $_SESSION['busqueda_estado']; ?>”</strong></p>
                <br>
                <button type="submit" class="button is-danger is-rounded">Eliminar busqueda</button>
            </form>
        </div>
    </div>
    <?php
          if(!isset($_GET['page'])){
                $pagina=1;
            }else{
                $pagina=(int) $_GET['page'];
                if($pagina<=1){
                    $pagina=1;
                }
            }

            $pagina=limpiar_cadena($pagina);
            $url="index.php?vista=statususer_search&page="; 
            $registros=10;
            $busqueda=$_SESSION['busqueda_estado']; 

            /* Paginador estado usuario */
            require_once "./php/estadousuario_listar.php";
        } 
    ?>
</div>