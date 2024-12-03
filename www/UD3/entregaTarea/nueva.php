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
                            <h2>Gestión de tarea</h2>
                        </div>

                        <div class="container justify-content-between">
                            <?php
                            require_once ('./conexiones/mysqli.php');
                            require_once ('funcionesDB.php');
                            
                                //comprueba validez de los datos introducidos en el formulario
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $titulo = entradaValida($_POST["titulo"]);
                                $descripcion = entradaValida($_POST["descripcion"]);
                                $estado = entradaValida($_POST["estado"]);
                                $id_usuario= entradaValida($_POST["id_usuario"]);
                                }
                                $resultado=nuevaTarea($titulo, $descripcion, $estado, $id_usuario);
                                
                                if ($resultado[0])
                                {
                                    echo '<div class="alert alert-success" role="alert">Tarea guardada correctamente.</div>';
                                }
                                else
                                {
                                    echo '<div class="alert alert-danger" role="alert">Ocurrió un error guardando la tarea: ' . $resultado[1] . '</div>';
                                }
                            ?>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>
