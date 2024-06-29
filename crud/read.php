<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

include '../config/config.php';

$sql = "SELECT id, title, description FROM records";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Leer</title>
    <link rel= "stylesheet" href="../stilo.css"/>
</head>
<body>
    <div class="formulario">
        <h1>Lista de registros</h1>
        <table border="1">
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
            <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["title"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";
                echo '<td><a href="update.php?id=' . $row["id"] . '">Editar</a>  <a href="delete.php?id=' . $row["id"] . '">Eliminar</a></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No hay registros</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="../index.php">Volver al inicio</a>
    </div>
    <?php include "../views/footer.php" ?>
</body>
</html>
