<?php
session_start();
require 'utils.php';
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
<?php
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
</div>
    </div>
    <!--footer-->
    <?php
          include 'footer.php';
          ?>
</body>
</html>
