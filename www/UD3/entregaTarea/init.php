<?php
function establecerConexion($host, $user, $pass, $db) {
    $conexion = new mysqli($host, $user, $pass, $db);
    return $conexion;
}

function conectarTareas(){
    return establecerConexion('db', 'root', 'test', 'tareas');
}

function cerrarConexion ($conexion){
    if (isset($conexion) && $conexion->connect_errno===0){
        $conexion-> close();
    }
}
function crearBDTareas(){
    try {
        $conexion = establecerConexion('db', 'root', 'test', null);
        if ($conexion->connect_error){
            return [false, $conexion->error];
        }
        else
        {
            // Verificar si la base de datos ya existe
            $sqlCheck = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'tareas'";
            $resultado = $conexion->query($sqlCheck);
            if ($resultado && $resultado->num_rows > 0) {
                return [false, 'La base de datos "tareas" ya existía.'];
            }

            $sql = 'CREATE DATABASE IF NOT EXISTS tareas';
            if ($conexion->query($sql))
            {
                return [true, 'Base de datos "tareas" fue creada correctamente'];
            }
            else
            {
                return [false, 'No se pudo crear la base de datos "tienda".'];
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
    
?>