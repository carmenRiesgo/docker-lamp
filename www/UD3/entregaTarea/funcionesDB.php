<?php

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
        $conexion = conexionMysqli('db', 'root', 'test', 'tareas');
        if ($conexion->connect_error){
            return [false, "la conexión no se ha establecido correctamente ". $conexion->error];
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
        $conexion = conexionMysqli('db', 'root', 'test', 'tareas');
        if ($conexion->connect_error){
            return [false, "la conexión no se ha establecido correctamente ". $conexion->error];
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
        }
    if ($conexion->query($sql))
    {
        return [true, 'Tabla "tareas" creada correctamente'];
    }
    else
    {
        return [false, 'No se pudo crear la tabla "tareas".'];
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
//FUNCIONES COMUNES DE FILTRADO DE DATOS
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

//Función que valida los campos de tipo VARCHAR
function validarCampoTexto($campo, $longitud)
{
    return (!empty(filtrarEntrada($campo) && validarLargoCampo($campo, $longitud)));
}

function validarLargoCampo($campo, $longitud)
{
    return (strlen(trim($campo)) > $longitud);
}


//FUNCIONES PARA GESTIONAR USUARIOS

// Función para guardar una nueva tarea en el array global
/*function nuevoUsuario($username, $nombre, $apellidos, $contraseña)
{
    try {
        $conn = establecerConexionPDO();
        $sql = "INSERT INTO usuarios (username, nombre, apellidos, contraseña)
                VALUES (:username, :nombre, :apellidos, :contraseña)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);       
        $stmt->bindParam(':contraseña', $contraseña, PDO::PARAM_STR);
        
        return $stmt->execute();
    }
    catch (PDOException $e) {
        error_log("Error al insertar el donante: " . $e->getMessage());
        return false;
    }
    finally
    {
        $conn = null;
    }
} 

function nuevoUsuario($username, $nombre, $apellidos, $contraseña)
{
    try {
        // Establecer conexión PDO
        $conn = establecerConexionPDO();

        // Cambia "contraseña" por "password" (recomendado) o usa backticks si no puedes cambiar el nombre
        $sql = "INSERT INTO usuarios (username, nombre, apellidos, password)
                VALUES (:username, :nombre, :apellidos, :password)";
        
        $stmt = $conn->prepare($sql);

        // Asignar valores a los parámetros
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);       
        $stmt->bindParam(':password', $contraseña, PDO::PARAM_STR);
        
        // Ejecutar la consulta
        return $stmt->execute();
    }
    catch (PDOException $e) {
        // Registrar errores y devolver falso
        error_log("Error al insertar el usuario: " . $e->getMessage());
        return false;
    }
    finally {
        // Cerrar conexión asignando null
        $conn = null;
    }
}*/

function nuevoUsuario($username, $nombre, $apellidos, $contraseña)
{
    try {
        // Intentar establecer la conexión
        $conn = establecerConexionPDO('tareas');

        // Definir la consulta SQL
        $sql = "INSERT INTO usuarios (username, nombre, apellidos, contraseña)
                VALUES (:username, :nombre, :apellidos, :contraseña)";
        
        // Preparar la consulta
        $stmt = $conn->prepare($sql);

        // Asignar valores a los parámetros
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);       
        $stmt->bindParam(':password', $contraseña, PDO::PARAM_STR);

        // Ejecutar la consulta
        return $stmt->execute();
    } catch (PDOException $e) {
        // Registrar el error y devolver falso
        error_log("Error al insertar el usuario: " . $e->getMessage());
        return false;
    } finally {
        // Liberar la conexión
        $conn = null;
    }
}

function listaTareas() {
    try {
        $conexion = conexionMysqli('db', 'root', 'test', 'tareas');

        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            // Consulta SQL para obtener los datos de tareas y usuarios
            $sql = "SELECT t.id, t.titulo, t.descripcion, t.estado, u.nombre AS nombre_usuario
             FROM tareas t
             INNER JOIN usuarios u ON t.id_usuario = u.id";
            
            $resultados = $conexion->query($sql);
            return [true, $resultados->fetch_all(MYSQLI_ASSOC)];
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