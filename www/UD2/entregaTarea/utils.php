<?php
    //función que permite listar las tareas almacenadas
    function obtenerTareas() {
        if (!isset($_SESSION['tareas'])) {
            $_SESSION['tareas'] = [];
         }
        return $_SESSION['tareas'];
        }
    //Función que permite filtrar los datos para que no lleven carácteres inválidos o código html
    function filtrarEntrada($entrada) {
        $entrada = trim ($entrada);
        $entrada = stripslashes ($entrada);
        $entrada = htmlspecialchars ($entrada);
        $entrada = preg_replace('/\s+/', "", $entrada);    
        return $entrada;
    }
    //Función que permite ver que la entrada ya filtrada es válida y el campo no está vacío
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
        return false;
    }

?>
