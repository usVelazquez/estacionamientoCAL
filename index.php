<?php
    session_start();

    include '../estacionamientoCAL/php/db.php'; //conexión a la base de datos

    $email = isset($_POST['useremail']) ? $_POST['useremail'] : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';

    //Validación del envio del formulario
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        //Validación de campos vacios
        if(empty($email) && empty($pass)){
            $message = 'Por favor, complete los campos';
            $messageType = 'error';
        }else{
            include '../estacionamientoCAL/php/db.php';
            //Busqueda del usuario
            $stmt = $conn->prepare("SELECT usuario_id, usuario_nombre, usuario_apellido1, usuario_apellido2, usuario_usuario, usuario_tel, usuario_email, usuario_pass, usuario_estatus, rol_id, admin_id FROM usuarios WHERE usuario_email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if($resultado->num_rows === 1){
                $user = $resultado->fetch_assoc();

                //Validamos contraseña
                if(password_verify($pass, $user['usuario_pass'])){
                    include './php/config.php';
                    //Guardar datos en la sesión
                    $_SESSION['usuario_nombre'] = $user['usuario_nombre'];
                    $_SESSION['usuario_usuario'] = $user['usuario_usuario'];
                    $_SESSION['rol_id'] = $user['rol_id'];
                    $_SESSION['admin_id'] = $user['admin_id'];

                    //Redirigit al inicio
                    header("Location: .../../vista/dashboard.php");
                    exit;
                }else{
                    $message = 'Contraseña incorrecta';
                    $messageType = 'error';
                }
            }else{
                $message = 'Usuario no registrado';
                $messageType = 'error';
            }
        }
    }else{
        $message = '';
        $messageType = '';
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estacionamientoCAL/style/index.css">
    <title>Inicio de Sesión CAL</title>
</head>
<body>
    <div class="container">
        <div class="form">
            <div class="info-form">
                <div class="icon-wrapper">
                    <img src="https://img.icons8.com/ios-filled/50/ffffff/car--v1.png" alt="logo-form" class="logo-form">
                </div>
                <h1>Sistema de Estacionamiento</h1>
                <p>Ingresa tus credenciales para acceder al panel de administración</p>
            </div>

            <?php if(!empty($message)): ?>
                <div class="alert <?php echo $messageType ?>" >
                    <?php echo htmlspecialchars($message)?>
                </div>
            <?php endif; ?>

            <div class="form-login">
                <form action="#" method="POST">
                    <div class="input-group">
                        <label for="useremail">Usuario</label>
                        <input type="email" id="useremail" name="useremail" placeholder="Ingresa tu usuario" required>
                    </div>
                    <div class="input-group">
                        <label for="pass">Contraseña</label>
                        <div class="password-wrapper">
                            <input type="password" id="pass" name="pass" placeholder="Ingresa tu contraseña" required>
                        </div>
                    </div>
                    <button type="submit">Iniciar Sesión</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
