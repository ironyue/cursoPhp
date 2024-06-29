<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel= "stylesheet" href="stilo.css"/>
</head>
<body>
    
    <div class="formulario">
        <h1>Bienvenid@, <?php echo $_SESSION['username']; ?>!</h1>
        <a href="crud/create.php">Crear nuevo registro</a><br>
        <br>
        <a href="crud/read.php">Ver registros</a><br>
        <br>
        <br>
        <a href="logout.php">Cerrar sesión</a>

    </div>

    
    <?php include "views/footer.php" ?>

</body>
</html>



