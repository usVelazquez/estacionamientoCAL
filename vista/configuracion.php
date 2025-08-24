<?php  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/navbar.css">
    <link rel="stylesheet" href="../style/configuracion.css">
    <title>Consfiguración - Estacionamiento CAL</title>
</head>
<body>
    <div class="container">
        <?php include '../include/navbar.php'; ?>

        <main>
            <div class="card">
                <div class="text">
                    <h4>Configuración de Tarifas</h4>
                    <p>Gestiona las tarifas del estacionamiento</p>
                </div>

                <div class="form">
                    <form action="">
                        <label for="tarifa-hora">Tarifa por Hora</label>
                        <input type="text" name="tarifa-hora" id="tarifa-hora" placeholder="25.00">

                        <label for="tarifa-diaria">Tarifa Diaria</label>
                        <input type="text" name="tarifa-diaria" id="tarifa-diaria" placeholder="200.00">

                        <input type="submit" value="Guardar Cambios">
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="text">
                    <h4>Configuración General</h4>
                    <p>Ajustes generales del sistema</p>
                </div>

                <div class="form">
                    <form action="">
                        <label for="nombre-estacionamiento">Tarifa por Hora</label>
                        <input type="text" name="nombre-estacionamiento" id="nombre-estacionamiento" placeholder="Estacionamiento Central">

                        <label for="max-horas">Tarifa Diaria</label>
                        <input type="text" name="max-horas" id="max-horas" placeholder="24">

                        <input type="submit" value="Actualizar">
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>