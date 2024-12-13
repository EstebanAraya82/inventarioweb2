<div class="main-container">
    <form class="box login" action="" method="POST" autocomplete="off">
        <h5 class="title is-5 has-text-centered is-uppercase">Sistema de inventario</h5>
        <h3 class="title is-5 has-text-centered is-uppercase">Login</h3>

        <div class="field">
            <label class="label">Usuario</label>
            <div class="control has-icons-left">
                <input class="input" type="text" name="login_usuario" placeholder="Ingrese su usuario" pattern="[a-zA-Z0-9@-.]{4,50}" maxlength="50" required>
                <span class="icon is-small is-left">
                    <i class="fas fa-user"></i>
                </span>
            </div>
        </div>

        <div class="field">
            <label class="label">Clave</label>
            <div class="control has-icons-left">
                <input class="input" type="password" name="login_clave" placeholder="Ingrese su clave" pattern="[a-zA-Z0-9$@.-]{7,50}" maxlength="50" required>
                <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                </span>
            </div>
        </div>

        <p class="has-text-centered mb-4 mt-3">
            <button type="submit" class="button is-info is-rounded">Iniciar sesión</button>
        </p>

        <?php
        if (isset($_POST['login_usuario']) && isset($_POST['login_clave'])) {
            require_once "./php/main.php";
            require_once "./php/iniciar_sesion.php";
        }
        ?>
    </form>
</div>
