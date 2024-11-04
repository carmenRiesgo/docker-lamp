<?php
/*$GLOBALS['tareas']= [ ['id' => '1', 'descripcion' => 'Primera tarea', 'estado' => 'pendiente'],
['id' => '2', 'descripcion' => 'Segunda tarea', 'estado' => 'en proceso'],];*/

function obtenerTareas() {
    if (!isset($_SESSION['tareas'])) {
        $_SESSION['tareas'] = [];
    }
    return $_SESSION['tareas'];
}

    function filtrarEntrada($entrada) {
    $entrada = trim ($entrada);
    $entrada = stripslashes ($entrada);
    $entrada = htmlspecialchars ($entrada);
    $entrada = preg_replace('/\s+/', "", $entrada);    
    return $entrada;
    }

    function entradaValida($entrada) {
        $entrada=filtrarEntrada($entrada);
        return !empty($entrada);
    }
// Función para guardar una nueva tarea en el array global
function guardarTarea($id, $descripcion, $estado) {
    // Validar campos
    if (entradaValida($id) && entradaValida($descripcion) && in_array($estado, ['pendiente', 'en proceso', 'completada'])) {
        $nuevaTarea = [
            'id' => filtrarEntrada($id),
            'descripcion' => filtrarEntrada($descripcion),
            'estado' => filtrarEntrada($estado)
        ];
        $_SESSION['tareas'][] = $nuevaTarea;
        return true;
    }
    return false;
}

?>
