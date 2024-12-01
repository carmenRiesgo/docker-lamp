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
                    <h2>Gestión de tarea</h2>
                </div>

                <div class="container justify-content-between">
                    <?php
                    require_once ('./conexiones/mysqli.php');
                    conexionMysqli('db', 'root', 'test', 'tareas');
                        try{
                           $conexion = new mysqli('db', 'root', 'test', 'tareas');
                           // Verificar si ocurrió un error en la conexión
                       if ($conexion->connect_errno) {
                           throw new mysqli_sql_exception("Error de conexión: " . $conexion->connect_error);
                       }
                              return $conexion;
                       
                        // define variables and set to empty values
                        $titulo = $descripcion = $estado = $id_usuario = "";
                        //comprueba validez de los datos introducidos en el formulario
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $titulo = test_input($_POST["titulo"]);
                        $descripcion = test_input($_POST["descripcion"]);
                        $estado = test_input($_POST["estado"]);
                        $id_usuario= test_input($_POST["id_usuario"]);
                        }

                        function test_input($data) {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                        }
                        //comprueba que se intodujeron datos en todos los campos
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (empty($_POST["titulo"])) {
                              $tituloErr = "Título es un campo obligatorio";
                            } else {
                              $titulo = test_input($_POST["titulo"]);
                            }
                          
                            if (empty($_POST["descripcion"])) {
                              $descripcionErr = "Descripcion es un campo obligatorio";
                            } else {
                              $descripcion = test_input($_POST["descripcion"]);
                            }
                                                                          
                            if (empty($_POST["estado"])) {
                              $estadoErr = "Estado es un campo obligatorio";
                            } else {
                              $estado = test_input($_POST["estado"]);
                            }
                          

                          if (empty($_POST["id_usuario"])) {
                            $id_usuarioErr = "Id del usuario  es un campo obligatorio";
                          } else {
                            $id_usuario = test_input($_POST["id_usuario"]);
                          }
                        }
                        $sql = "INSERT INTO tareas ($titulo, $descripcion, $estado) 
                        VALUES ('programación', 'crear consulta clientes', 'en proceso' );";

                            if ($conexion->query($sql)) {
                                echo 'Se ha creado un nuevo registro<br>';
                            }
                            else {
                                echo 'No se pudo crear el registro: ' . $conexion->error;
                            }



                        }
                        catch (mysqli_sql_exception $e) {
                            return [false, $e->getMessage()];
                        }

                        cerrarConexion ($conexion);
                        
/*// Incluir el archivo con las funciones de conexión
include 'funcionesDB.php'; // Asegúrate de que el archivo se llame funcionesDB.php y esté en el mismo directorio

// Configuración de la base de datos
$host = "db";
$user = "root";
$pass = "test";
$db = "tareas";

// Crear conexión utilizando la función personalizada
$conexion = conexionMysqli($host, $user, $pass, $db);

// Verificar si hubo un error al conectar
if (is_array($conexion) && $conexion[0] === false) {
    die("Error al conectar con la base de datos: " . $conexion[1]);
}

// Validar y filtrar datos del formulario
$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
$descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
$estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
$id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT);

// Validar datos del formulario
if (!$titulo || strlen($titulo) > 50) {
    die("El título no es válido.");
}

if ($descripcion && strlen($descripcion) > 250) {
    die("La descripción no es válida.");
}

if (!$estado || !in_array($estado, ["Pendiente", "En Progreso", "Completada"])) {
    die("El estado no es válido.");
}

if (!$id_usuario) {
    die("El ID de usuario no es válido.");
}

try {
    // Verificar si el usuario existe
    $sql = "SELECT id FROM usuarios join tareas WHERE id = $id_usuario";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("El usuario con ID $id_usuario no existe.");
    }

    // Insertar la nueva tarea
    $sql = "INSERT INTO tareas (titulo, descripcion, estado, id_usuario) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssi", $titulo, $descripcion, $estado, $id_usuario);

    if ($stmt->execute()) {
        echo "Tarea creada con éxito.";
    } else {
        echo "Error al crear la tarea: " . $stmt->error;
    }

    // Cerrar el statement
    $stmt->close();
} catch (mysqli_sql_exception $e) {
    echo "Error en la consulta: " . $e->getMessage();
}

// Cerrar conexión utilizando la función personalizada
cerrarConexion($conexion);*/
?>
                    
                    

                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>
