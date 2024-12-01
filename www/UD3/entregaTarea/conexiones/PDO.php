<?php
//Establecer conexión PDO
function establecerConexionPDO($dbname){

    $servername='db';
    $username='root';
    $password='test';
    $dbname=$dbname;    

try{
    $conn= new PDO("mysql:host=$servername,dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATT_ERRMODE, PDO::ERRMODE_EXCEPTION);
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