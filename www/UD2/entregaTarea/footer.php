<!--Apartado 3 tarea UD02-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <!-- código php para generar pie de página en el fichero index.html-->
        <?php
            $fecha=date('j/m/Y');
            echo "<br/>";
            echo "<span>&copy</span> 2024-205 DIWCS - Carmen Riesgo Lopez.  $fecha";
        ?>
    </body>
</html>