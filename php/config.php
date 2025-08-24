<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();//Iniciar sesión si no está iniciada
    }

    date_default_timezone_set('America/Mexico_City');
?>