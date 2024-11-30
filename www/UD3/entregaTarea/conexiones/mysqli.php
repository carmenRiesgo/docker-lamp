<?php
//Establecer conexión en modo Mysqli
function conexionMysqli($host, $user, $pass, $db) {
 try{
    $conexion = new mysqli($host, $user, $pass, $db);
    // Verificar si ocurrió un error en la conexión
if ($conexion->connect_errno) {
    throw new mysqli_sql_exception("Error de conexión: " . $conexion->connect_error);
}
       return $conexion;
}
catch (mysqli_sql_exception $e) {
    return [false, $e->getMessage()];
}
}

function cerrarConexion ($conexion){
    if (isset($conexion) && ($conexion->connect_errno===0)){
        $conexion-> close();
    }
}
?>
