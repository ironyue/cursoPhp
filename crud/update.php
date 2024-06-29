<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE records SET title = ?, description = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $description, $id);

    if ($stmt->execute()) {
        echo "Registro actualizado exitosamente!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $id = $_GET['id'];
    $sql = "SELECT title, description FROM records WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar</title>
    <link rel= "stylesheet" href="../stilo.css"/>
</head>
<body>
    <div class="formulario">
        <h1>Actualizar un registro</h1>
        <form action="update.php" method="post">
            <div class="username">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="title">Título:</label>
                <input type="text" name="title" value="<?php echo $row['title']; ?>" required>
            </div>
            <div class="username">
                <label for="description">Descripción:</label>
                <textarea name="description" required><?php echo $row['description']; ?></textarea>
            </div>
            
            <button type="submit">Actualizar</button>
        </form>
        <br>
        <a href="read.php">Volver a la lista</a>
    </div>
    <?php include "../views/footer.php" ?>
</body>
</html>
