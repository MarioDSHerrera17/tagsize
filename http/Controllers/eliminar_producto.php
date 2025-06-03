<<<<<<< HEAD
<?php
require_once 'db_connection.php'; // Conecta con tu base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id === null || !is_numeric($id)) {
        die("ID inválido.");
    }

    $sql = "DELETE FROM productos WHERE id_productos = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ver_productos.php?mensaje=eliminado");
        exit();
    } else {
        echo "❌ Error al eliminar el producto.";
    }

    $stmt->close();
    $conn->close();
} else {
    die("Método no permitido.");
}
=======
<?php
require_once 'db_connection.php'; // Conecta con tu base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id === null || !is_numeric($id)) {
        die("ID inválido.");
    }

    $sql = "DELETE FROM productos WHERE id_productos = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ver_productos.php?mensaje=eliminado");
        exit();
    } else {
        echo "❌ Error al eliminar el producto.";
    }

    $stmt->close();
    $conn->close();
} else {
    die("Método no permitido.");
}
>>>>>>> 6e6044f0db3f2e69cd53519e0f16e656b79f9463
