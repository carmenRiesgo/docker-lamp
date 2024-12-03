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
               

                require('funcionesDB.php'); // Define funciones como nuevoUsuario()
                require_once('./conexiones/PDO.php'); // Define la conexión a la base de datos

                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    //Recuperamos los datos del formulario
                    $nombre = $_POST['nombre'];
                    $apellidos = $_POST['apellidos'];
                    $username = $_POST['username'];
                    $contraseña = $_POST['contraseña'];
                }

                if (!empty($_POST)) { // Cambiado a POST
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
                
                /*if (!empty($_GET)) {
                   
                    // Validar entradas   
                    $username = entradaValida($_GET['username']);
             
                    $nombre = entradaValida($_GET['nombre']);
            
                    $apellidos = entradaValida($_GET['apellidos']); 
             
                    $contraseña = entradaValida($_GET['contraseña']); // Asegúrate de que esta función cifre la contraseña
            
                    $error=false;
                   // Validar  que no haya errores en los campos
                   if (!validarCampoTexto($username))
                   {
                       $error = true;
                 
                       echo '<div class="alert alert-danger" role="alert">Revisa el campo usuario.</div>';
                   }
                   if (!validarCampoTexto($nombre))
                   {
                       $error = true;
                  
                       echo '<div class="alert alert-danger" role="alert">Revisa el campo nombre.</div>';
                   }
                   if (!validarCampoTexto($apellidos))
                   {
                       $error = true;
                 
                       echo '<div class="alert alert-danger" role="alert">Revisa el campo apellidos.</div>';
                   }
                   if (!validarCampoTexto($contraseña))
                   {
                       $error = true;
                
                       echo '<div class="alert alert-danger" role="alert">Revisa el campo contraseña.</div>';
                   } 
                    if(!$error)
                    {
                       
                        if (nuevoUsuario($username, $nombre, $apellidos, $contraseña))
                        {
                            echo '<div class="alert alert-success" role="alert">Usuario registrado correctamente.</div>'; 

                        } else {
                            echo '<div class="alert alert-danger" role="alert">Ocurrió un error registrando el usuario.</div>'; 
                        }
                    }  else {
                        echo '<div class="alert alert-warning" role="alert">No se pudo procesar el contenido del formulario.</div>';
                         
                    }
                
                }*/
                
                ?>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>