<?php
    //Recopilación de datos del formulario
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $ltname1 = isset($_POST['ltname1']) ? $_POST['ltname1'] : '';
    $ltname2 = isset($_POST['ltname2']) ? $_POST['ltname2'] : '';
    $user = isset($_POST['user']) ? $_POST['user'] : '';
    $tel = isset($_POST['tel']) ? $_POST['tel'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
    $repass = isset($_POST['repass']) ? $_POST['repass'] : '';
    $rol = isset($_POST['rol']) ? $_POST['rol'] : '';
    $permiso = isset($_POST['permiso']) ? 1 : 0;
    $estatus = 'activo';

    //Validación del envio del formulario
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Validación de campos vacios
        if(empty($name) || empty($ltname1) || empty($ltname2) || empty($user) || empty($tel) || empty($email) || empty($pass) || empty($repass)){
            $message = "Por favor, ingresa todos los datos";
            $messageType = 'error';
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $message = 'Formato del correo inválido';
            $messageType = 'error';
        }elseif(empty($rol)){
            $message = "Escoge el rol";
            $messageType = 'error';
        }elseif($pass !== $repass){ //Validación de contraseñas
            $message = "Las contraseñas no coinciden";
            $messageType = 'error';
        }else{
            include '../php/db.php';

            //Verificar que el usuario exista
            $check = $conn->prepare("SELECT usuario_id FROM usuarios WHERE usuario_email = ? OR usuario_usuario = ?");
            $check->bind_param('ss', $email, $user);
            $check->execute();
            $check->store_result();
            if($check->num_rows > 0){
                $message = 'El usuario o correo ya existe';
                $messageType = 'error';
            }else{
                $conn->begin_transaction();

                try{
                    //Insertar datos en T-administración
                    $stmt = $conn->prepare("INSERT INTO administracion (admin_permiso) VALUES (?)");
                    $stmt->bind_param('i', $permiso);
                    $stmt->execute();
                    $admin_id = $conn->insert_id;
                    $stmt->close();

                    //Insertar datos en T-roles
                    $stmt2 = $conn->prepare("INSERT INTO roles (rol_descrip) VALUES (?)");
                    $stmt2->bind_param('s', $rol);
                    $stmt2->execute();
                    $rol_id = $conn->insert_id;
                    $stmt2->close();

                    //Insertar datos en T-usuarios
                    $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
                    $stmt3 = $conn->prepare("INSERT INTO usuarios (usuario_nombre, usuario_apellido1, usuario_apellido2, usuario_usuario, usuario_tel, usuario_email, usuario_pass, usuario_estatus, admin_id, rol_id) VALUES (?,?,?,?,?,?,?,?,?,?)");
                    $stmt3->bind_param('ssssssssii', $name, $ltname1, $ltname2, $user, $tel, $email, $pass_hash, $estatus, $admin_id, $rol_id);
                    $stmt3->execute();
                    $stmt3->close();

                    $conn->commit();
                    header('Location: ../vista/home.php');
                    exit;
                }catch(Exception $e){
                    $conn->rollback();
                    $message = 'Error al registrar usuario: ' .$e->getMessage();
                    $messageType = 'error';
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../style/navbar.css">
    <link rel="stylesheet" href="../style/register.css" />
    <title>Registro de Usuarios - CAL</title>
</head>
<body>
    <?php include '../include/navbar.php'; ?>
    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <div class="text">
                    <h1>Nuevo usuario</h1>
                    <p>Crea una cuenta para que el personal acceda al sistema</p>
                </div>
                <div class="button-exit">
                    <a href="../vista/dashboard.php" class="btn-exit">← Volver al panel</a>
                </div>
            </div>

            <div class="form-card">
                <div class="form-top">
                    <div class="icon-text">
                        <img src="../desingh/icons8-add-user-male-32.png" alt="iconnAddAccount">
                        <div>
                            <h3>Registrar nuevo usuario</h3>
                            <p>Completa la información para agregar un nuevo usuario del sistema</p>
                        </div>
                    </div>
                </div>

                <?php if(!empty($message)): ?>
                    <div class="alert <?php echo $messageType ?>">
                        <?php echo htmlspecialchars($message) ?>
                    </div>
                <?php endif; ?>

                <!-- FORMULARIO -->
                <form action="" name="usuarios" method="POST" class="form">
                    <!-- Nombre, Apellidos y Usuario -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Nombre(s)</label>
                            <input type="text" name="name" id="name" placeholder="Ej. Juan" value="<?php echo $name ?>">
                        </div>
                        <div class="form-group">
                            <label for="ltname1">Apellido paterno</label>
                            <input type="text" name="ltname1" id="ltname1" placeholder="Ej. Pérez" value="<?php echo $ltname1 ?>">
                        </div>
                        <div class="form-group">
                            <label for="ltname2">Apellido materno</label>
                            <input type="text" name="ltname2" id="ltname2" placeholder="Ej. Rodríguez" value="<?php echo $ltname2 ?>">
                        </div>
                        <div class="form-group">
                            <label for="user">Usuario</label>
                            <input type="text" name="user" id="user" placeholder="Ej. juanperez" value="<?php echo $user ?>">
                        </div>
                    </div>

                    <!-- Correo y Teléfono -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="email" name="email" id="email" placeholder="admin@estacionamiento.com" value="<?php echo $email ?>">
                        </div>
                        <div class="form-group">
                            <label for="tel">Teléfono (opcional)</label>
                            <input type="tel" name="tel" id="tel" placeholder="+52 55 1234 5678" value="<?php echo $tel ?>">
                        </div>
                    </div>

                    <!-- Rol -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="rol">Rol</label>
                            <select name="rol" id="rol">
                                <option value="">Selecciona un rol</option>
                                <option value="administrador">Administrador</option>
                                <option value="cajero">Cajero</option>
                                <option value="guardia">Guardia</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="permiso">Permisos</label>
                            <select name="permiso" id="permiso">
                                <option value="">Selecciona los permisos</option>
                                <option value="usuarios">Gestion de Usuarios</option>
                                <option value="tarifas">Configuración de Tarifas</option>
                            </select>
                        </div>
                    </div>

                    <!-- Contraseñas -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="pass">Contraseña</label>
                            <input type="password" name="pass" id="pass" placeholder="********" value="<?php echo $pass ?>">
                        </div>
                        <div class="form-group">
                            <label for="repass">Repetir contraseña</label>
                            <input type="password" name="repass" id="repass" placeholder="********" value="<?php echo $repass ?>">
                        </div>
                        <!-- boton pendiente "GENERADOR DE CONTRASEÑAS" 
                        <button type="button" class="btn-generate">Generar temporal</button>
                        -->
                    </div>

                    <!-- Botones -->
                    <div class="form-actions">
                        <input type="reset" value="Limpiar" class="btn-reset">
                        <input type="submit" name="register" value="Registrar usuario" class="btn-submit">
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
</html>
