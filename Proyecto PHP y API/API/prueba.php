<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $nombre = "";
        if (isset($_GET["nombre"])){
            $nombre = $_GET["nombre"];

        }

        echo $nombre;

    ?>
    
</body>
</html>