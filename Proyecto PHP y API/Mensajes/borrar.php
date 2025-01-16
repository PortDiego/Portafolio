<!DOCTYPE html>
<html>
    <head>
        <?php include_once "menu.php" ?>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/estilos.css">
    </head>
    <body>
        <?php
            $formulario = FormularioVista::fromBody();

            $listado= ServicioMensajes::obtenerMensaje();

        ?>

        <form method="POST" action="borrar.php">
            
            <?php if (isset($_POST["Aceptar"])): ?>
                <h2>¡Tu mensaje se ha borrado con exito!</h2>
        
                <?php
                    ServicioMensajes::borrarMensaje($formulario->id);
                ?>

                <a href= "index.php"> Publicar un nuevo mensaje </a>

            <?php elseif (($_POST["id"])): ?>
                <h3>Vas a borrar el siguiente mensaje con ID: <?php echo $formulario->id; ?></h3>

                <?php foreach($listado as $mensaje): ?>
                    <?php if($mensaje->id == $formulario->id): ?>
                        <div class="borde margen"> 
                        <p><?php echo $mensaje->nombre; ?> </p>
                        <p><?php echo $mensaje->texto; ?></p>
                        <p><?php echo $mensaje->depago; ?></p>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

                <div>
                    <button name="Aceptar">Aceptar</button>
                    <button name="Cancelar" formaction="index.php">Cancelar</button>
                </div>
            <?php endif; ?>

           
            <div><input type="hidden" name="nombre" value="<?php echo $formulario->nombre; ?>"/></div>
            <div><input type="hidden" name="texto" value="<?php echo $formulario->texto; ?>"/></div>
            <div><input type="hidden" name="depago" value="<?php echo $formulario->depago; ?>"/></div>
            <div><input type="hidden" name="id" value="<?php echo $formulario->id; ?>"/></div>

        </form> 
    </body>
</html>