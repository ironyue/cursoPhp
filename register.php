<?php
include 'config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Verificar si el usuario ya existe
    $checkUser = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $checkUser->bind_param("s", $username);
    $checkUser->execute();
    $checkUser->store_result();

    if ($checkUser->num_rows > 0) {
        echo "El nombre de usuario ya está en uso.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            $_SESSION['user_id'] = $conn->insert_id;
            echo "Registro exitoso!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $checkUser->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel= "stylesheet" href="stilo.css"/>
</head>
<body>
    <div class="formulario">
        <h1>Registrarse</h1>
        <form action="" method="post">
            <div class="username">
                <label for="username">Usuario:</label>
                <input type="text" name="username" required>
            </div>

            <div class="username">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" required>
            </div>

            <div class="registrarse">
                <button type="submit">Registrar</button>
            </div>
            <br>
            <br>
            <a href="../index.php">Volver al inicio</a>
        </form>
    </div>
    <?php include "views/footer.php" ?>
</body>
</html>
