<?php
session_start();
require 'utils.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $estado = $_POST['estado'] ?? '';

    if (guardarTarea($id, $descripcion, $estado)) {
        echo "<p class='alert alert-success'>Tarea guardada con éxito.</p>";
    } else {
        echo "<p class='alert alert-danger'>Error al guardar la tarea. Verifique los campos.</p>";
    }
}

?>
