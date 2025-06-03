<<<<<<< HEAD
<?php
require_once 'db_connection.php';

$nombre = $_POST['nombre_usuario'] ?? '';
$email = $_POST['email_usuario'] ?? '';
$password = $_POST['password_usuario'] ?? '';
$tipo = $_POST['tipo_usuario'] ?? '';
$fecha = date('Y-m-d H:i:s');

// Validaciones básicas
if (empty($nombre) || empty($email) || empty($password) || empty($tipo)) {
    die("❌ Todos los campos son obligatorios.");
}

// Validar email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("❌ El correo electrónico no es válido.");
}

// Hashear contraseña
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Insertar en la base de datos
$sql = "INSERT INTO usuarios (nombre_usuario, email_usuario, password_usuario, tipo_usuario, fecha_registro_usuario) VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $nombre, $email, $password_hash, $tipo, $fecha);

if ($stmt->execute()) {
    header("Location: ver_usuarios.php?mensaje=exito");
    exit();
} else {
    header("Location: ver_usuarios.php?mensaje=error");
    exit();
}

$stmt->close();
$conn->close();
?>
=======
<?php
require_once 'db_connection.php';

$nombre = $_POST['nombre_usuario'] ?? '';
$email = $_POST['email_usuario'] ?? '';
$password = $_POST['password_usuario'] ?? '';
$tipo = $_POST['tipo_usuario'] ?? '';
$fecha = date('Y-m-d H:i:s');

// Validaciones básicas
if (empty($nombre) || empty($email) || empty($password) || empty($tipo)) {
    die("❌ Todos los campos son obligatorios.");
}

// Validar email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("❌ El correo electrónico no es válido.");
}

// Hashear contraseña
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Insertar en la base de datos
$sql = "INSERT INTO usuarios (nombre_usuario, email_usuario, password_usuario, tipo_usuario, fecha_registro_usuario) VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $nombre, $email, $password_hash, $tipo, $fecha);

if ($stmt->execute()) {
    header("Location: ver_usuarios.php?mensaje=exito");
    exit();
} else {
    header("Location: ver_usuarios.php?mensaje=error");
    exit();
}

$stmt->close();
$conn->close();
?>
>>>>>>> 6e6044f0db3f2e69cd53519e0f16e656b79f9463
