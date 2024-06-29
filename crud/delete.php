<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: ../auth/login.php");
    exit;
}

include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Verificar si el registro existe
    $checkSql = "SELECT id FROM records WHERE id = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // El registro existe, proceder a eliminarlo
        $deleteSql = "DELETE FROM records WHERE id = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $id);

        if ($deleteStmt->execute()) {
            // Redirigir a la lista de registros después de la eliminación exitosa
            $deleteStmt->close();
            
            // Resetear auto_increment
            $resetAutoIncrement = "ALTER TABLE records AUTO_INCREMENT = 1";
            $conn->query($resetAutoIncrement);

            $stmt->close();
            $conn->close();
            header("Location: read.php");
            exit;
        } else {
            echo "Error: " . $deleteStmt->error;
        }

        $deleteStmt->close();
    } else {
        echo "Registro no encontrado.";
    }

    $stmt->close();
    $conn->close();
} else {
    $id = $_GET['id'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar</title>
    <link rel= "stylesheet" href="../stilo.css"/>
</head>
<body>
    <div class="formulario">
        <h1>Eliminar un registro</h1>
        <form action="delete.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <p>¿Estás seguro de que deseas eliminar este registro?</p>
            <button type="submit">Eliminar</button>
        </form>
    </div>
    <br>
    <a href="read.php">Volver a la lista</a>
    <?php include "../views/footer.php" ?>
</body>
</html>
