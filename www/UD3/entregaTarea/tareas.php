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
                    <h2>Listado de tareas</h2>
                </div>

                <div class="container justify-content-between">
                <?php require_once('funcionesDB.php'); ?>
                    <div class="table">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>                            
                                    <th>Identificador</th>    
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Nombre Usuario</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Conectar a la base de datos
                                include_once('./conexiones/PDO.php');
                                include_once('./conexiones/mysqli.php');
                                $usuario=null;
                                if (!empty ($_GET)&&isset($_GET['usuario'])){
                                    $usuario=$_GET['usuario'];
                                    $lista=listaTareasPDO($usuario);
                                    
                                }
                                else
                                {
                                    $lista = listaTareas();
                                }
                                if ($lista[0]) {
                                    $tareas = $lista[1];   
                                    foreach ($tareas as $tarea) {
                                                echo '<tr>';
                                                echo '<td>' . $tarea['id'] . '</td>';
                                                echo '<td>' . $tarea['titulo'] . '</td>';
                                                echo '<td>' . $tarea['descripcion'] . '</td>';
                                                echo '<td>' . $tarea['estado'] . '</td>';
                                                echo '<td>' . $tarea['nombre_usuario'] . '</td>';
                                                echo '<td>'. '<a class="btn btn-outline-success btn-sm me-1" href="editarUsuario.php?id=' . $tarea['id'] . '" role="button">Editar</a>'.'</td>' ;
                                                echo '<td>'. '<a class="btn btn-outline-danger btn-sm" href="borraTarea.php?id=' . $tarea['id'] . '" role="button">Borrar</a>'.'<td>' ;
                                                echo '</tr>';     

                                    }
                                    
                                } else {
                                    echo "Error al obtener la lista de tareas: " . $lista[1];
                                }                           
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>
