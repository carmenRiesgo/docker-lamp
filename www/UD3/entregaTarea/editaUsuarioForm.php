<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD3. Tarea</title>
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
                <?php
                        require_once('./conexiones/PDO.php')
                        require_once('funcionesDB.php');
                        
                        if (!empty($_GET))
                        {
                            $id = $_GET['id'];
                            $resultado = buscaUsuario($id);
                            if (!empty($id) && $resultado[0])
                            {
                                $usuario = $resultado[1];
                                $username= $usuario['username'];
                                $nombre = $usuario['nombre'];
                                $apellidos = $usuario['apellidos'];
                                $contraseña = $usuario['contrasena'];
                               
                        ?>
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <?php include_once('form.php'); ?>
                            
                <div class="container justify-content-between">
                    <form action="editaUsuario.php" method="POST" class="mb-5 w-50">
                        
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($username) ? htmlspecialchars($username) : '' ?>"required>
                         
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($nombre) ? htmlspecialchars($nombre) : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo isset($apellidos) ? htmlspecialchars($apellidos) : '' ?>"required>                           
                        </div>
                        <div class="mb-3">
                            <label for="contraseña" class="form-label">Contraseña</label>
                            <input type="text" class="form-control" id="contraseña" name="contraseña" value="<?php echo isset($contraseña) ? htmlspecialchars($contraseña) : '' ?>"required>                            
                        </div>
                        <button type="submit" class="btn btn-success btn-sm">Actualizar</button>
                        <?php
                            }
                            else
                            {
                                echo '<div class="alert alert-danger" role="alert">No se pudo recuperar la información del usuario.</div>';
                            }
                        }
                        else
                        {
                            echo '<div class="alert alert-danger" role="alert">Debes acceder a través del listado de usuarios.</div>';
                        }
                        ?>
                        <button type="submit" class="btn btn-primary">Modificar</button>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>
