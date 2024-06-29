<?php
include 'config/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("location: index.php");
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel= "stylesheet" href="stilo.css"/>
</head>
<body>
    <div class="formulario">
        <h1>Inicio de Sesion</h1>
        <form action="" method="post">
            <div class="username">
                <label for="username">Usuario:</label>
                <input type="text" name="username" required>
            </div>
            <div class="username">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Iniciar</button>
            <br>
            <br>
            <a href="../index.php">Volver al inicio</a>
        </form>
    </div>
    <?php include "views/footer.php" ?>

</body>
</html>
