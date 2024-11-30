<?php
//Establecer conexión PDO
function establecerConexionPDO{

    $servername='db';
    $username='root';
    $password='test';
    $dbname='tareas';    

try{
    $conn= new PDO("mysql:host=$servername,dbname=$dbname,$username,");
    $conn->setAttribute(PDO::ATT_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
    }
    catch(PDOexception $e) {
        return [false, $e->getMessage()];
        }
    }
//cerrar conexión PDO
function cerrarConexionPDO($conn){
    $conn=null;
}        
?>