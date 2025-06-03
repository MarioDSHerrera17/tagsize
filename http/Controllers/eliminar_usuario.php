<?php
require_once 'db_connection.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM usuarios WHERE id_usuarios= ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

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
    die("❌ ID no proporcionado.");
}
?>
