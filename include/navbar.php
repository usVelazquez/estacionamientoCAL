<header>
    <nav>
        <div class="nav-right">
            <img src="../desingh/icons8-estacionamiento-48.png" alt="logo">
            <h4>Panel de Administrador</h4>
        </div>

        <div class="left">
            <div class="dropdown">
                <button class="dropdown-button" onclick="toggleDropdown()">
                    Bienvenido 
                    <?php
                        include '../php/config.php';
                        if(isset($_SESSION['usuario_usuario'])){
                            $user = $_SESSION['usuario_usuario'];
                            echo htmlspecialchars($user);//Mostrar nombre de usuario
                        }else{
                            echo 'Usuario';//Mensaje si no hay usuario
                        }
                    ?>
                </button>

                <div class="dropdown-content" id="myDropdown">
                    <a href="../vista/dashboard.php">Dashboard</a>
                    <a href="#">Mi perfil</a>
                    <a href="../vista/registerUser.php">Agregar usuario</a>
                    <a href="../vista/configuracion.php">Configuración</a>
                </div>
            </div>

            <div class="logout">
                <button class="logout-button">
                    <img src="../desingh/icons8-salida-48.png" alt="iconLogout">Cerrar Sesión
                </button>
            </div>
        </div>
    </nav>
</header>

<script>
function toggleDropdown() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Cierra el menú si se hace clic fuera de él
window.onclick = function(event) {
    if (!event.target.matches('.dropdown-button')) {
        let dropdowns = document.getElementsByClassName("dropdown-content");
        for (let i = 0; i < dropdowns.length; i++) {
            if (dropdowns[i].classList.contains('show')) {
                dropdowns[i].classList.remove('show');
            }
        }
    }
}
</script>