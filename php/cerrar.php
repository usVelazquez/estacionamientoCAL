<?php
    require 'config.php';

    // Destruimos la sesión
    session_unset();
    session_destroy();

    header('Location: ../vista/home.php')
?>
