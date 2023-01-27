<?php require_once 'includes/redireccion.php'; ?>

<?php require_once 'includes/cabecera.php'; ?>

<?php require_once 'includes/lateral.php'?>

<!--Caja principal-->
    <div id="principal">
        <h1>Crear categorías</h1>

        <p>
            Añade nuevas caterias al blog para que la usen los usuarios
        </p>
        <br/>
        <form action="guardar-categoria.php" method="post">
            <label for="nombre">Nombre de la categoria</label>
            <input type="text" name="nombre">

            <input type="submit" value="Guardar"/>
        </form>

    </div>
<!--Fin principal-->


<!--Pie de pagina-->
<?php require_once 'includes/pie.php' ?>