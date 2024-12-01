<?php
//Establecer conexión PDO
function establecerConexionPDO(){

    $servername="db";
    $username="root";
    $password="test";
    $dbname="tareas";    

try{
    $conn= new PDO ("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
    }
    catch(PDOexception $e) {
        die("Error de conexión: " . $e->getMessage());
        }
    }
    

//cerrar conexión PDO
function cerrarConexionPDO($conn){
    $conn=null;
}  

?>