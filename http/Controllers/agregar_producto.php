<<<<<<< HEAD
<?php
require_once 'db_connection.php';

// Recoge los datos del formulario
$codigo_barras = $_POST['codigo_barras'] ?? '';
$nombre = $_POST['nombre_producto'] ?? '';
$marca = $_POST['marca_producto'] ?? '';
$precio = $_POST['precio_producto'] ?? 0;
$stock = $_POST['stock_del_producto'] ?? 0;
$descripcion = $_POST['descripcion_producto'] ?? '';
$fecha = date('Y-m-d H:i:s');

// Validaciones básicas
if (empty($codigo_barras) || empty($nombre) || empty($marca) || empty($precio) || empty($stock) || empty($descripcion) || !isset($_FILES['imagen_producto'])) {
    die("❌ Todos los campos son obligatorios.");
}

// Validar subida de imagen
if ($_FILES['imagen_producto']['error'] !== UPLOAD_ERR_OK) {
    die("❌ Error al subir la imagen. Código: " . $_FILES['imagen_producto']['error']);
}

// Validar tipo MIME
$imagen_temp = $_FILES['imagen_producto']['tmp_name'];
$tipo_imagen = mime_content_type($imagen_temp);
$tipos_permitidos = ['image/jpeg', 'image/png', 'image/webp'];

if (!in_array($tipo_imagen, $tipos_permitidos)) {
    die("❌ Solo se permiten imágenes JPG, PNG o WEBP.");
}

// Validar tamaño
$tamano_maximo = 2 * 1024 * 1024; // 2MB
if ($_FILES['imagen_producto']['size'] > $tamano_maximo) {
    die("❌ La imagen excede los 2MB permitidos.");
}

// Crear carpeta si no existe
$directorio_subida = "uploads/";
if (!is_dir($directorio_subida)) {
    mkdir($directorio_subida, 0755, true);
}

// Guardar imagen con nombre único
$nombre_original = basename($_FILES['imagen_producto']['name']);
$nombre_unico = uniqid() . "_" . preg_replace("/[^a-zA-Z0-9.\-_]/", "_", $nombre_original);
$ruta_imagen = $directorio_subida . $nombre_unico;

if (!move_uploaded_file($imagen_temp, $ruta_imagen)) {
    die("❌ Error al mover la imagen al directorio destino.");
}

// Insertar en la base de datos
$sql = "INSERT INTO productos (
            codigo_barras, nombre_producto, marca_producto,
            precio_producto, stock_del_producto, descripcion_producto,
            imagen_producto, fecha_creacion_producto
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssdisss", $codigo_barras, $nombre, $marca, $precio, $stock, $descripcion, $ruta_imagen, $fecha);

if ($stmt->execute()) {
    header("Location: ver_productos.php?mensaje=exito");
    exit(); // <- Muy importante para detener el script
} else {
    header("Location: ver_productos.php?mensaje=error");
    exit();
}

$stmt->close();
$conn->close();
?>
=======
<?php
require_once 'db_connection.php';

// Recoge los datos del formulario
$codigo_barras = $_POST['codigo_barras'] ?? '';
$nombre = $_POST['nombre_producto'] ?? '';
$marca = $_POST['marca_producto'] ?? '';
$precio = $_POST['precio_producto'] ?? 0;
$stock = $_POST['stock_del_producto'] ?? 0;
$descripcion = $_POST['descripcion_producto'] ?? '';
$fecha = date('Y-m-d H:i:s');

// Validaciones básicas
if (empty($codigo_barras) || empty($nombre) || empty($marca) || empty($precio) || empty($stock) || empty($descripcion) || !isset($_FILES['imagen_producto'])) {
    die("❌ Todos los campos son obligatorios.");
}

// Validar subida de imagen
if ($_FILES['imagen_producto']['error'] !== UPLOAD_ERR_OK) {
    die("❌ Error al subir la imagen. Código: " . $_FILES['imagen_producto']['error']);
}

// Validar tipo MIME
$imagen_temp = $_FILES['imagen_producto']['tmp_name'];
$tipo_imagen = mime_content_type($imagen_temp);
$tipos_permitidos = ['image/jpeg', 'image/png', 'image/webp'];

if (!in_array($tipo_imagen, $tipos_permitidos)) {
    die("❌ Solo se permiten imágenes JPG, PNG o WEBP.");
}

// Validar tamaño
$tamano_maximo = 2 * 1024 * 1024; // 2MB
if ($_FILES['imagen_producto']['size'] > $tamano_maximo) {
    die("❌ La imagen excede los 2MB permitidos.");
}

// Crear carpeta si no existe
$directorio_subida = "uploads/";
if (!is_dir($directorio_subida)) {
    mkdir($directorio_subida, 0755, true);
}

// Guardar imagen con nombre único
$nombre_original = basename($_FILES['imagen_producto']['name']);
$nombre_unico = uniqid() . "_" . preg_replace("/[^a-zA-Z0-9.\-_]/", "_", $nombre_original);
$ruta_imagen = $directorio_subida . $nombre_unico;

if (!move_uploaded_file($imagen_temp, $ruta_imagen)) {
    die("❌ Error al mover la imagen al directorio destino.");
}

// Insertar en la base de datos
$sql = "INSERT INTO productos (
            codigo_barras, nombre_producto, marca_producto,
            precio_producto, stock_del_producto, descripcion_producto,
            imagen_producto, fecha_creacion_producto
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssdisss", $codigo_barras, $nombre, $marca, $precio, $stock, $descripcion, $ruta_imagen, $fecha);

if ($stmt->execute()) {
    header("Location: ver_productos.php?mensaje=exito");
    exit(); // <- Muy importante para detener el script
} else {
    header("Location: ver_productos.php?mensaje=error");
    exit();
}

$stmt->close();
$conn->close();
?>
>>>>>>> 6e6044f0db3f2e69cd53519e0f16e656b79f9463
