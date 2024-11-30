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
                    <h2>Inicio</h2>
                </div>

                <div class="container justify-content-between">
<?php
//Establecer conexión en modo Mysqli
require_once('./conexiones/mysqli.php');

function conectarTareas(){
    return conexionMysqli('db', 'root', 'test', 'tareas');
}


function crearBDTareas(){
    try {
        $conexion = conexionMysqli('db', 'root', 'test', null);
        if ($conexion->connect_error){
            return [false, "la conexión no se ha establecido correctamente ". $conexion->error];
        } else {
            // Verificar si la base de datos ya existe
            $sqlCheck = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'tareas'";
            $resultado = $conexion->query($sqlCheck);
            if ($resultado && $resultado->num_rows > 0) {
                return [false, 'La base de datos "tareas" ya existía.'];
            }
            //Creación de la base de datos
            $sql = 'CREATE DATABASE IF NOT EXISTS tareas';
            if ($conexion->query($sql))
            {
                return [true, 'Base de datos "tareas" fue creada correctamente'];
            }
            else
            {
                return [false, 'No se pudo crear la base de datos "tareas".'];
            }
        }
    }
    catch (mysqli_sql_exception $e) {
            return [false, $e->getMessage()];
      }
      finally
      {
      cerrarConexion($conexion);
      }
    }

function crearTablaUsuarios(){
    try {
        $conexion = conectaTareas();
        
        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        } else {
            // Verificar si la tabla ya existe
            $sqlCheck = "SHOW TABLES LIKE 'usuarios'";
            $resultado = $conexion->query($sqlCheck);

            if ($resultado && $resultado->num_rows > 0){
                return [false, 'La tabla "usuarios" ya existe'];
            } 
            //creación de la tabla usuarios.
            $sql = '
                CREATE TABLE IF NOT EXISTS `tareas`.`usuarios` (
                `id` INT NOT NULL AUTO_INCREMENT , 
                `username` VARCHAR(50) NOT NULL ,
                `nombre` VARCHAR(50) NOT NULL ,
                `apellidos` VARCHAR(100) NOT NULL ,
                `contraseña` VARCHAR(100) NOT NULL ,
                PRIMARY KEY (`id`)
                )
                ';
    if ($conexion->query($sql))
    {
        return [true, 'Tabla "usuarios" creada correctamente'];
    }
    else
    {
        return [false, 'No se pudo crear la tabla "usuarios".'];
    }
}
}
catch (mysqli_sql_exception $e)
{
return [false, $e->getMessage()];
}
finally
{
cerrarConexion($conexion);
}
} 

function crearTablaTareas(){
    try {
        $conexion = conectaTareas();
        
        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        } else {
            // Verificar si la tabla ya existe
            $sqlCheck = "SHOW TABLES LIKE 'tareas'";
            $resultado = $conexion->query($sqlCheck);

            if ($resultado && $resultado->num_rows > 0){
                return [false, 'La tabla "tareas" ya existe'];
            }    
            //Crear tabla tareas
            $sql = '
                CREATE TABLE `tareas`.`tareas` (
                `id` INT NOT NULL AUTO_INCREMENT , 
                `titulo` VARCHAR(50) NOT NULL , 
                `descripcion` VARCHAR(250) NOT NULL , 
                `estado` VARCHAR(50) NOT NULL , 
                `id_usuario` INT NOT NULL , 
                PRIMARY KEY (`id`),
                FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE
                )
                ';

    if ($conexion->query($sql))
    {
        return [true, 'Tabla "tareas" creada correctamente'];
    }
    else
    {
        return [false, 'No se pudo crear la tabla "tareas".'];
    }
}
}
catch (mysqli_sql_exception $e)
{
return [false, $e->getMessage()];
}
finally
{
cerrarConexion($conexion);
}
} 
   
?>

</main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>
