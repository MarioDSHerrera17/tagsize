<?php
require_once 'db_connection.php';

if (
    isset($_POST['id_usuario'], $_POST['nombre_usuario'], $_POST['email_usuario'], $_POST['tipo_usuario'])
) {
    $id = $_POST['id_usuario'];
    $nombre = $_POST['nombre_usuario'];
    $email = $_POST['email_usuario'];
    $tipo = $_POST['tipo_usuario'];
    $password = $_POST['password_usuario'] ?? '';

    // Validar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("❌ El correo electrónico no es válido.");
    }

    // Actualización con o sin cambio de contraseña
    if (!empty($password)) {
        // Cambiar contraseña
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET nombre_usuario = ?, email_usuario = ?, tipo_usuario = ?, password_usuario = ? WHERE id_usuarios = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $nombre, $email, $tipo, $password_hash, $id);
    } else {
        // Sin cambiar contraseña
        $sql = "UPDATE usuarios SET nombre_usuario = ?, email_usuario = ?, tipo_usuario = ? WHERE id_usuarios = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nombre, $email, $tipo, $id);
    }

    if ($stmt->execute()) {
        header("Location: ver_usuarios.php?mensaje=exito");
        exit();
    } else {
        header("Location: ver_usuarios.php?mensaje=error");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    die("❌ Datos incompletos.");
}
?>
