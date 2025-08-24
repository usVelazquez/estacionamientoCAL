<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/dasboard.css">
    <link rel="stylesheet" href="../style/navbarMain.css">
    <link rel="stylesheet" href="../style/navbar.css">
    <title>Dashboard - Estacionamiento CAL</title>
</head>
<body>
    <div class="container">
        <?php include '../include/navbar.php'; ?>

        <main>
            <div class="card">  <!--INGRESOS-->
                <div class="text">
                    <div class="tittle">
                        <img src="../desingh/icons8-arrow-64.png" alt="iconResumen" class="iconResumen">
                        <h4>Resumen de Ingresos</h4>
                    </div>

                    <div>
                        <p>Ingresos del mes 
                            <?php
                                $month_num = date('m');
                                switch ($month_num){
                                    case 1:
                                        echo 'Enero';
                                        break;
                                    case 2:
                                        echo 'Feberero';
                                        break;
                                    case 3:
                                        echo 'Marzo';
                                        break;
                                    case 4:
                                        echo 'Abril';
                                        break;
                                    case 5:
                                        echo 'Mayo';
                                        break;
                                    case 6:
                                        echo 'Junio';
                                        break;
                                    case 7:
                                        echo 'Julio';
                                        break;
                                    case 8:
                                        echo 'Agosto';
                                        break;
                                    case 9:
                                        echo 'Septiembre';
                                        break;
                                    case 10:
                                        echo 'Octubre';
                                        break;
                                    case 11:
                                        echo 'Noviembre';
                                        break;
                                    case 12:
                                        echo 'Diciembre';
                                        break;
                                }
                            ?>
                        </p>
                    </div>
                </div>

                <!--Card de ingresos-->
                <div class="analysis-container">
                    <div class="analysis">
                        <span>$68,500</span><!--Agregar código php-->
                        <p>Ingresos del Mes</p>
                    </div>
                </div>

                <div class="analysis-container">
                    <div class="analysis">
                        <span>$2,283</span><!--Agregar código php-->
                        <p>Promedio diario</p>
                    </div>
                </div>

                <div class="analysis-container">
                    <div class="analysis">
                        <span>59%</span><!--Agregar código php-->
                        <p>Tasa de ocupación</p>
                    </div>
                </div>
            </div>

            <div class="card-grid">
                <div class="card">  <!--ACTIVIDAD-->
                    <div class="text">
                        <div class="tittle">
                            <img src="#" alt="iconActivity">
                            <h4>Actividad Reciente</h4>
                        </div>

                        <div>
                            <p>Últimos movimientos en el estacionamiento de hoy <?php echo date('d/m/Y'); ?></p>
                        </div>
                    </div>

                    <div class="activity">
                        <div class="activity-container">
                            <div>
                                <p>Entrada</p>
                                <p>Folio Ticket</p>
                            </div>

                            <p>Hora del evento</p>
                        </div>
                    </div>
                </div>

                <div class="card">    <!--CONFIGURACIÓN-->
                    <div class="text">
                        <div class="tittle">
                            <img src="#" alt="iconConfig">
                            <h4>Acciones Rápidas</h4>
                        </div>
                    </div>

                    <div class="config">
                        <div class="config-container">
                            <div class="config-list">
                                <a href="#">
                                    <img src="#" alt="iconReport">
                                    <p>Ver Reportes</p>
                                </a>
                            </div>

                            <div class="config-list">
                                <a href="#">
                                    <img src="#" alt="iconGestor">
                                    <p>Gestionar Usuarios</p>
                                </a>
                            </div>

                            <div class="config-list">
                                <a href="#">
                                    <img src="#" alt="iconTarifas">
                                    <p>Configurar Tarifas</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>