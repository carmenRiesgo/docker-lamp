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
                    if (!empty($_GET))
                    {
                        require_once('utils.php');
                        $username = filtraCampo($_POST['username']);
                        $nombre = filtraCampo($_POST['nombre']);
                        $apellidos = filtraCampo($_POST['apellidos']);
                        $contraseña = filtraCampo($_POST['contraseña']);
                    
                    // Validar  que no haya errores en los campos
                    if (!validarCampoTexto($username))
                    {
                        $error=true;
                        echo '<div class="alert-danger" role="alert">**Revisa el nombre de usuario**</div>';
                    }
                    if (!validarCampoTexto($nombre))
                    {
                        $error=true;
                        echo '<div class="alert-danger" role="alert">**Revisa el nombre**</div>';
                    }
                    
                    if (!validarCampoTexto($apellidos))
                    {
                        $error=true;
                        echo '<div class="alert-danger" role="alert">**Revisa los apellidos**</div>';
                    }
                    if (!validarCampoTexto($contraseña))
                    {
                        $error=true;
                        echo '<div class="alert-danger" role="alert">**Revisa la contraseña**</div>';
                    }

                    if(!error)
                    {
                        require_once('pdo.php');
                        if (nuevoUsuario($username, $nombre, $apellidos, $contraseña))
                        {
                            echo '<div class="alert alert-success" role="alert">Usuario registrado correctamente.</div>'; 

                        } else {
                            echo '<div class="alert alert-danger" role="alert">Ocurrió un error registrando el usuario.</div>'; 
                        }
                    }  else {
                        echo '<div class="alert alert-warning" role="alert">No se pudo procesar el contenido del formulario.</div>';
                         
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
