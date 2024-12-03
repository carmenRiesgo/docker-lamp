<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD2. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include_once('header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Nuevo Usuario</h2>
                </div>

                <div class="container justify-content-between">
                <?php
                require_once('funcionesDB.php');
                require_once('./conexiones/PDO.php'); 

                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    //Recuperamos los datos del formulario
                    $nombre = $_POST['nombre'];
                    $apellidos = $_POST['apellidos'];
                    $username = $_POST['username'];
                    $contraseña = $_POST['contraseña'];
                }

                if (!empty($_POST)) { 
                    // Validar entradas
                    $username = entradaValida($_POST['username']);
                    $nombre = entradaValida($_POST['nombre']);
                    $apellidos = entradaValida($_POST['apellidos']);
                    $contraseña = entradaValida($_POST['contraseña']);
                
                    $errores = [];
                
                    // Validar campos individuales
                    if (!validarCampoTexto($username)) {
                        $errores[] = 'Revisa el campo usuario.';
                    }
                    if (!validarCampoTexto($nombre)) {
                        $errores[] = 'Revisa el campo nombre.';
                    }
                    if (!validarCampoTexto($apellidos)) {
                        $errores[] = 'Revisa el campo apellidos.';
                    }
                    if (!validarCampoTexto($contraseña)) {
                        $errores[] = 'Revisa el campo contraseña.';
                    }
                
                    if (!empty($errores)) {
                        // Mostrar todos los errores acumulados
                        foreach ($errores as $error) {
                            echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                        }
                    } else {
                        // Cifrar la contraseña
                        $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);

                    $resultado=nuevoUsuario($username, $nombre, $apellidos, $contraseña);
            
                        // Intentar registrar el usuario
                        if ($resultado) {
                            echo "Usuario registrado con ID: $resultado";
                        } else {
                            echo "??????Error al registrar el usuario.";
                        }
                    }
                }
                
                ?>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>