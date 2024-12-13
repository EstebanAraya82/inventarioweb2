<nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="index.php?vista=home">
            <img src="./img/logo.png" width="60" height="28">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Usuarios</a>    
               <div class="navbar-dropdown">
                    <a class="navbar-item" href="index.php?vista=user_new"> Nuevo usuario</a>
                    <a class="navbar-item" href="index.php?vista=user_list">Listar usuarios</a>
                    <a class="navbar-item" href="index.php?vista=user_search">Buscar usuarios</a>
                                      
                   </div>               
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Activos</a>    
               <div class="navbar-dropdown">
                    <a class="navbar-item" href="index.php?vista=asset_new"> Nuevo activo</a>
                    <a class="navbar-item" href="index.php?vista=asset_list">Listar activos</a>
                    <a class="navbar-item" href="index.php?vista=asset_search">Buscar activos</a>
                    <a class="navbar-item" href="index.php?vista=category_list">Categoria</a>
                   </div>               
            </div>    
             
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Piso</a>    
               <div class="navbar-dropdown">
                    <a class="navbar-item" href="index.php?vista=floor_new"> Nuevo piso</a>
                    <a class="navbar-item" href="index.php?vista=floor_list">Listar pisos</a>
                    <a class="navbar-item" href="index.php?vista=floor_search">Buscar piso</a>
                   </div>               
            </div>  
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Posición</a>    
               <div class="navbar-dropdown">
                    <a class="navbar-item" href="index.php?vista=position_new"> Nueva pisición</a>
                    <a class="navbar-item" href="index.php?vista=position_list">Listar posiciones</a>
                    <a class="navbar-item" href="index.php?vista=position_search">Buscar posición</a>
                   </div>               
            </div>  
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Área</a>    
               <div class="navbar-dropdown">
                    <a class="navbar-item" href="index.php?vista=area_new"> Nueva área</a>
                    <a class="navbar-item" href="index.php?vista=area_list">Listar áreas</a>
                    <a class="navbar-item" href="index.php?vista=area_search">Buscar área</a>
                   </div>               
            </div>  
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Sector</a>    
               <div class="navbar-dropdown">
                    <a class="navbar-item" href="index.php?vista=sector_new"> Nuevo sector</a>
                    <a class="navbar-item" href="index.php?vista=sector_list">Lista de sectores</a>
                    <a class="navbar-item" href="index.php?vista=sector_search">Buscar sector</a>
                   </div>               
            </div>                          
             <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Solicitud de baja</a>    
               <div class="navbar-dropdown">
                    <a class="navbar-item" href="index.php?vista=assetderegistration_new"> Nueva solicitud</a>
                    <a class="navbar-item" href="index.php?vista=assetderegistration_list">Lista de solicitudes</a>
                    <a class="navbar-item" href="index.php?vista=assetderegistration_search">Buscar solicitud</a>
                   </div>               
            </div>  
            </div> 
            </div> 
            </div> 
                               
                    <a href="index.php?vista=logout" class="button is-link is-rounded">
                        Salir
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>