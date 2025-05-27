<?php
require_once 'db_connection.php';

$query = "SELECT * FROM productos";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ver Productos</title>
  <link rel="icon" type="image/jpeg" href="../../public/img/logo-removebg-preview.png">
  <link rel="stylesheet" href="../../css/styles_ver_productos.css">
</head>
<body>

  <div class="container">
    <h1>Lista de Productos</h1>
    <a href="#" class="btn-agregar" onclick="abrirModal()">Agregar Producto</a>
    <a href="../../html/dashboard.html" class="btn-regreso">🔙 Regresar</a>

    <!-- MODAL AGREGAR -->
    <!-- MODAL AGREGAR -->
<div id="modalAgregar" class="modal">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarModal()">&times;</span>
    <h2>Agregar Nuevo Producto</h2>
    <form action="agregar_producto.php" method="post" enctype="multipart/form-data">
      <input type="text" name="codigo_barras" placeholder="Código de barras" required>
      <input type="text" name="nombre_producto" placeholder="Nombre" required>
      <input type="text" name="marca_producto" placeholder="Marca" required>
      <input type="number" step="0.01" name="precio_producto" placeholder="Precio" required>
      <input type="number" name="stock_del_producto" placeholder="Stock" required>
      <textarea name="descripcion_producto" placeholder="Descripción" required></textarea>

      <!-- Personalización input file -->
      <div class="file-input-wrapper">
        <label for="imagen_producto" class="file-label">Seleccionar Imagen</label>
        <input type="file" name="imagen_producto" id="imagen_producto" accept="image/*" required>
        <span class="file-name" id="file-name">Ningún archivo seleccionado</span>
      </div>

      <button type="submit">Guardar</button>
    </form>        
  </div>
</div>

<!-- MODAL EDITAR -->
<div id="modalEditar" class="modal">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarModalEditar()">&times;</span>
    <h2>Editar Producto</h2>
    <form action="editar_producto.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id_productos" id="editar-id">
      <input type="text" name="codigo_barras" id="editar-codigo" placeholder="Código de barras" required>
      <input type="text" name="nombre_producto" id="editar-nombre" placeholder="Nombre" required>
      <input type="text" name="marca_producto" id="editar-marca" placeholder="Marca" required>
      <input type="number" step="0.01" name="precio_producto" id="editar-precio" placeholder="Precio" required>
      <input type="number" name="stock_del_producto" id="editar-stock" placeholder="Stock" required>
      <textarea name="descripcion_producto" id="editar-descripcion" placeholder="Descripción" required></textarea>

      <!-- Personalización input file -->
      <div class="file-input-wrapper">
        <label for="editar-imagen" class="file-label">Seleccionar Imagen (opcional)</label>
        <input type="file" name="imagen_producto" id="editar-imagen" accept="image/jpeg,image/png,image/webp">
        <span class="file-name" id="file-name-edit">Ningún archivo seleccionado</span>
      </div>

      <button type="submit">Guardar Cambios</button>
    </form>
  </div>
</div>


    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Código de Barras</th>
          <th>Nombre</th>
          <th>Marca</th>
          <th>Precio</th>
          <th>Stock</th>
          <th>Descripción</th>
          <th>Imagen</th>
          <th>Fecha de Creación</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id_productos'] ?></td>
            <td><?= $row['codigo_barras'] ?></td>
            <td><?= htmlspecialchars($row['nombre_producto']) ?></td>
            <td><?= htmlspecialchars($row['marca_producto']) ?></td>
            <td>$<?= number_format($row['precio_producto'], 2) ?></td>
            <td><?= $row['stock_del_producto'] ?></td>
            <td><?= htmlspecialchars($row['descripcion_producto']) ?></td>
            <td>
              <?php if (!empty($row['imagen_producto'])): ?>
                <img src="<?= htmlspecialchars($row['imagen_producto']) ?>" alt="Imagen" class="img-producto">
              <?php else: ?>
                Sin imagen
              <?php endif; ?>
            </td>
            <td><?= $row['fecha_creacion_producto'] ?></td>
            <td>
              <button class="btn-editar" onclick="abrirModalEditar(
                <?= $row['id_productos'] ?>,
                '<?= htmlspecialchars($row['codigo_barras'], ENT_QUOTES) ?>',
                '<?= htmlspecialchars($row['nombre_producto'], ENT_QUOTES) ?>',
                '<?= htmlspecialchars($row['marca_producto'], ENT_QUOTES) ?>',
                <?= $row['precio_producto'] ?>,
                <?= $row['stock_del_producto'] ?>,
                '<?= htmlspecialchars($row['descripcion_producto'], ENT_QUOTES) ?>'
              )">Editar</button>

              <form action="eliminar_producto.php" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');" style="display:inline;">
                <input type="hidden" name="id" value="<?= $row['id_productos'] ?>">
                <button type="submit" class="btn-eliminar">Eliminar</button>
               </form>

            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <!-- JS para el modal -->
  <script>
    function abrirModal() {
      document.getElementById("modalAgregar").style.display = "block";
    }

    function cerrarModal() {
      document.getElementById("modalAgregar").style.display = "none";
    }

    window.onclick = function(event) {
      const modal = document.getElementById("modalAgregar");
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>
  <script>
    function abrirModalEditar(id, codigo, nombre, marca, precio, stock, descripcion) {
      document.getElementById("editar-id").value = id;
      document.getElementById("editar-codigo").value = codigo;
      document.getElementById("editar-nombre").value = nombre;
      document.getElementById("editar-marca").value = marca;
      document.getElementById("editar-precio").value = precio;
      document.getElementById("editar-stock").value = stock;
      document.getElementById("editar-descripcion").value = descripcion;
  
      document.getElementById("modalEditar").style.display = "block";
    }

    function cerrarModalEditar() {
      document.getElementById("modalEditar").style.display = "none";
    }

    window.onclick = function(event) {
      const modal = document.getElementById("modalEditar");
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
</script>

</body>
</html>
