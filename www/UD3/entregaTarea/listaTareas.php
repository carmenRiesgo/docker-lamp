<?php
// listaTareas.php, 

session_start();
include 'utils.php';

$tareas = obtenerTareas();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD2. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
          include 'header.php';
          ?>
    <div class="container-fluid">
        <div class="row">
            <!--menu-->
          <?php
          include 'menu.php';
          ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h2>Listado de Tareas</h2> 
            </div> 
            <div class="table">
                    <table class="table table-striped table-hover">                    
                        <thead class="thead">
                            <tr>                            
                                <th>Identificador</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--Bucle para generar listado de tareas con datos introducidos en el formulario-->
                            <?php foreach ($tareas as $tarea): ?>
                            <tr>
                                <td><?php echo $tarea['id']; ?></td>
                                <td><?php echo $tarea['descripcion']; ?></td>
                                <td><?php echo $tarea['estado']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    <!--footer-->
        <?php
          include 'footer.php';
        ?>
</body>
</html>