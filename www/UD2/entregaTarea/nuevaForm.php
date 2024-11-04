<!--Apartado 5, tarea UD2-->
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
          <!--código html para crear el formulario que permite grabar las tareas y enviarlas al fichero nueva.php-->         
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Creación nuevas tareas</h2>
                </div>
                <div>            
                    <form class="mb-5" name="creación-tareas" action="nueva.php" method="post">
                        <div class="mb-3">    
                            <label class="form-label" for="id">Identificador:</label><br>
                            <input class="form-control" type="text" id="id" name="id"><br>
                        </div>
                        <div class="mb-3">  
                            <label class="form-label" for="descripcion">Descripción:</label><br>
                            <input class="form-control" type="text" id="descripcion" name="descripcion"><br>
                        </div>
                        <div class="mb-3"> 
                            <label for="estado">Elige un estado</label>
                            <select class="form-select" name="estado" id="estado">
                                <option value="pendiente">Pendiente</option>
                                <option value="en proceso">En proceso</option>
                                <option value="completada">Completada</option>
                            </select>                   
                            <br>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <!--footer-->
        <?php
          include 'footer.php';
        ?>
    </body>
</html>