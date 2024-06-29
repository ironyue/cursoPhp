<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO records (title, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $description);

    if ($stmt->execute()) {
        echo "Registro creado exitosamente!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
//
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear</title>
    <link rel= "stylesheet" href="../stilo.css"/>
</head>
<body>
    <div class="formulario">
        <h1>Crear un nuevo registro</h1>
        <form action="create.php" method="post">
            <div class="username">
                <label for="title">Título:</label>
                <input type="text" name="title" required>
            </div>
            <div class="username">
                <label for="description">Descripción:</label>
                <textarea name="description" required></textarea>
            </div>
            <div class="registrarse">
                <button type="submit">Crear</button>
            </div>
        </form>
        <br>
        <a href="../index.php">Volver al inicio</a>
    </div>
    <?php include "../views/footer.php" ?>
</body>
</html>
