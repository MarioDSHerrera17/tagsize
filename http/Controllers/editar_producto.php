<?php
require_once 'db_connection.php';

// Verifica que todos los datos hayan sido enviados
if (
    isset($_POST['id_productos'], $_POST['codigo_barras'], $_POST['nombre_producto'],
          $_POST['marca_producto'], $_POST['precio_producto'],
          $_POST['stock_del_producto'], $_POST['descripcion_producto'])
) {
    $id = $_POST['id_productos'];
    $codigo = $_POST['codigo_barras'];
    $nombre = $_POST['nombre_producto'];
    $marca = $_POST['marca_producto'];
    $precio = $_POST['precio_producto'];
    $stock = $_POST['stock_del_producto'];
    $descripcion = $_POST['descripcion_producto'];

    $imagenNueva = false;
    $ruta_imagen = '';

    // Validar si se cargó una imagen
    if (isset($_FILES['imagen_producto']) && $_FILES['imagen_producto']['error'] === UPLOAD_ERR_OK) {
        $imagen_temp = $_FILES['imagen_producto']['tmp_name'];
        $tipo_imagen = mime_content_type($imagen_temp);
        $tipos_permitidos = ['image/jpeg', 'image/png', 'image/webp'];

        if (!in_array($tipo_imagen, $tipos_permitidos)) {
            die("❌ Solo se permiten imágenes JPG, PNG o WEBP.");
        }

        if ($_FILES['imagen_producto']['size'] > 2 * 1024 * 1024) {
            die("❌ La imagen excede los 2MB permitidos.");
        }

        $directorio = "uploads/";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755, true);
        }

        $nombre_original = basename($_FILES['imagen_producto']['name']);
        $nombre_unico = uniqid() . "_" . preg_replace("/[^a-zA-Z0-9.\-_]/", "_", $nombre_original);
        $ruta_imagen = $directorio . $nombre_unico;

        if (!move_uploaded_file($imagen_temp, $ruta_imagen)) {
            die("❌ Error al mover la imagen.");
        }

        $imagenNueva = true;
    }

    if ($imagenNueva) {
        $sql = "UPDATE productos 
                SET codigo_barras = ?, nombre_producto = ?, marca_producto = ?, 
                    precio_producto = ?, stock_del_producto = ?, descripcion_producto = ?, 
                    imagen_producto = ?
                WHERE id_productos = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssdissi", $codigo, $nombre, $marca, $precio, $stock, $descripcion, $ruta_imagen, $id);
    } else {
        $sql = "UPDATE productos 
                SET codigo_barras = ?, nombre_producto = ?, marca_producto = ?, 
                    precio_producto = ?, stock_del_producto = ?, descripcion_producto = ?
                WHERE id_productos = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssdisi", $codigo, $nombre, $marca, $precio, $stock, $descripcion, $id);
    }

    if ($stmt->execute()) {
        header("Location: ver_productos.php?mensaje=editado");
        exit();
    } else {
        echo "❌ Error al actualizar el producto: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "❌ Faltan datos del formulario.";
}

$conn->close();
?>
