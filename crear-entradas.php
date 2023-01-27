<?php require_once 'includes/redireccion.php'; ?>

<?php require_once 'includes/cabecera.php'; ?>

<?php require_once 'includes/lateral.php'?>

    <!--Caja principal-->
    <div id="principal">
        <h1>Crear entradas</h1>

        <p>
            Añade nuevas entradas al blog para que la usen los usuarios puedan leerlas
        </p>
        <br/>
        <form action="guardar-entrada.php" method="post">

            <label for="titulo">Nombre de la Entrada</label>
            <input type="text" name="titulo">
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'titulo') :'';?>

            <label for="descripcion">Descripción</label>
            <textarea name="descripcion"></textarea>
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'descripcion') :'';?>

            <label for="categoria">Categoría</label>
            <select name="categoria">
                <?php
                    $categorias = conseguirCategorias($db);
                    if(!empty($categorias)):
                    while ($categoria=mysqli_fetch_assoc($categorias)):
                ?>
                    <option value="<?= $categoria['id']?>">
                       <?=$categoria['nombre'] ?>
                    </option>
                <?php
                    endwhile;
                    endif;
                ?>
            </select>
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'categoria') :'';?>
            <input type="submit" value="Guardar"/>
        </form>
        <?php borrarErrores(); ?>

    </div>
    <!--Fin principal-->


    <!--Pie de pagina-->
<?php require_once 'includes/pie.php' ?>