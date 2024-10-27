<?php
// listaTareas.php

session_start();
require 'utils.php';

$tareas = obtenerTareas();
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset utf-8>    
    <title>listarTareas</title>
    </head>
    <body>
        
    
<div class="table">
    <table class="table table-striped table-hover">
    <caption>Listado de Tareas</caption>    
    <thead class="thead">
            <tr>                            
                <th>Identificador</th>
                <th>Descripción</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
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
</body>
</html>