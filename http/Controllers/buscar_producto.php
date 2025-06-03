<?php
// Conectar a la base de datos
require_once 'db_connection.php';

header('Content-Type: application/json');

// Validar si el código fue proporcionado por GET
if (!isset($_GET['codigo']) || empty($_GET['codigo'])) {
    echo json_encode(['ok' => false, 'msg' => 'Código de barras no proporcionado']);
    exit;
}

$codigo = $_GET['codigo'];

// Preparar y ejecutar la consulta
$stmt = $conn->prepare("SELECT 
    id_productos, 
    codigo_barras, 
    nombre_producto, 
    marca_producto, 
    precio_producto, 
    stock_del_producto, 
    descripcion_producto, 
    imagen_producto, 
    fecha_creacion_producto 
    FROM productos 
    WHERE codigo_barras = ?");
$stmt->bind_param("s", $codigo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $producto = $result->fetch_assoc();
    // Arreglar la ruta de la imagen
    $producto['imagen_producto'] = '../http/Controllers/' . $producto['imagen_producto'];
    echo json_encode(['ok' => true, 'producto' => $producto]);
} else {
    echo json_encode(['ok' => false, 'msg' => 'Producto no encontrado']);
}

$stmt->close();
$conn->close();
?>
