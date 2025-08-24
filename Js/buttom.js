<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Botón Desplegable con Clic</title>
  <style>
    /* Contenedor del botón */
    .dropdown {
      position: relative;
      display: inline-block;
    }

    /* Botón principal */
    .dropdown-button {
      background-color: #3498db;
      color: white;
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      cursor: pointer;
    }

    /* Contenido del menú (inicialmente oculto) */
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: white;
      min-width: 160px;
      box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
      z-index: 1;
    }

    /* Opciones dentro del menú */
    .dropdown-content a {
      color: black;
      padding: 10px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {
      background-color: #f1f1f1;
    }

    /* Opcional: cambiar color del botón al pasar el mouse */
    .dropdown-button:hover {
      background-color: #2980b9;
    }
  </style>
</head>
<body>

<div class="dropdown">
  <button class="dropdown-button" onclick="toggleDropdown()">Menú</button>
  <div class="dropdown-content" id="myDropdown">
    <a href="#">Opción 1</a>
    <a href="#">Opción 2</a>
    <a href="#">Opción 3</a>
  </div>
</div>

<script>
  // Función para alternar la visibilidad del menú
  function toggleDropdown() {
    const dropdownContent = document.getElementById("myDropdown");
    dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
  }

  // Cerrar el menú si se hace clic fuera de él
  window.onclick = function(event) {
    if (!event.target.matches('.dropdown-button')) {
      const dropdowns = document.getElementsByClassName("dropdown-content");
      for (let i = 0; i < dropdowns.length; i++) {
        const openDropdown = dropdowns[i];
        if (openDropdown.style.display === "block") {
          openDropdown.style.display = "none";
        }
      }
    }
  }
</script>

</body>
</html>
