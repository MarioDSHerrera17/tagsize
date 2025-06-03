<<<<<<< HEAD
<?php
require_once 'db_connection.php';

$query = "SELECT * FROM usuarios";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ver Usuarios</title>
  <link rel="icon" type="image/jpeg" href="../../public/img/logo-removebg-preview.png">
  <link rel="stylesheet" href="../../css/styles_ver_usuarios.css">
</head>
<body>

  <div class="container">
    <h1>Lista de Usuarios</h1>
    <a href="#" class="btn-agregar" onclick="abrirModal()">Agregar Usuario</a>
    <a href="../../html/dashboard.html" class="btn-regreso">🔙 Regresar</a>

    <!-- MODAL AGREGAR -->
    <div id="modalAgregar" class="modal">
      <div class="modal-contenido">
        <span class="cerrar" onclick="cerrarModal()">&times;</span>
        <h2>Agregar Nuevo Usuario</h2>
        <form action="agregar_usuario.php" method="post">
          <input type="text" name="nombre_usuario" placeholder="Nombre completo" required>
          <input type="email" name="email_usuario" placeholder="Correo electrónico" required>
          <input type="password" name="password_usuario" placeholder="Contraseña" required>
          <select name="tipo_usuario" required>
            <option value="">Selecciona tipo de usuario</option>
            <option value="A">Administrador</option>
            <option value="E">Empleado</option>
          </select>
          <button type="submit">Guardar</button>
        </form>        
      </div>
    </div>

    <!-- MODAL EDITAR -->
    <div id="modalEditar" class="modal">
      <div class="modal-contenido">
        <span class="cerrar" onclick="cerrarModalEditar()">&times;</span>
        <h2>Editar Usuario</h2>
        <form action="editar_usuario.php" method="post">
          <input type="hidden" name="id_usuario" id="editar-id">
          <input type="text" name="nombre_usuario" id="editar-nombre" placeholder="Nombre completo" required>
          <input type="email" name="email_usuario" id="editar-email" placeholder="Correo electrónico" required>
          <input type="password" name="password_usuario" id="editar-password" placeholder="Contraseña (dejar vacío para no cambiar)">
          <select name="tipo_usuario" id="editar-tipo" required>
            <option value="A">Administrador</option>
            <option value="E">Empleado</option>
          </select>
          <button type="submit">Guardar Cambios</button>
        </form>
      </div>
    </div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Tipo</th>
          <th>Fecha de Registro</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id_usuarios'] ?></td>
            <td><?= htmlspecialchars($row['nombre_usuario']) ?></td>
            <td><?= htmlspecialchars($row['email_usuario']) ?></td>
            <td><?= $row['tipo_usuario'] === 'A' ? 'Administrador' : 'Empleado' ?></td>
            <td><?= $row['fecha_registro_usuario'] ?></td>
            <td>
              <button class="btn-editar" onclick="abrirModalEditar(
                <?= $row['id_usuarios'] ?>,
                '<?= htmlspecialchars($row['nombre_usuario'], ENT_QUOTES) ?>',
                '<?= htmlspecialchars($row['email_usuario'], ENT_QUOTES) ?>',
                '', // No enviamos la contraseña al editar para seguridad
                '<?= $row['tipo_usuario'] ?>'
              )">Editar</button>

              <form action="eliminar_usuario.php" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');" style="display:inline;">
                <input type="hidden" name="id" value="<?= $row['id_usuarios'] ?>">
                <button type="submit" class="btn-eliminar">Eliminar</button>
               </form>

            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <!-- JS para los modales -->
  <script>
    function abrirModal() {
      document.getElementById("modalAgregar").style.display = "block";
    }

    function cerrarModal() {
      document.getElementById("modalAgregar").style.display = "none";
    }

    function abrirModalEditar(id, nombre, email, password, tipo) {
      document.getElementById("editar-id").value = id;
      document.getElementById("editar-nombre").value = nombre;
      document.getElementById("editar-email").value = email;
      document.getElementById("editar-password").value = ''; // limpiar campo contraseña
      document.getElementById("editar-tipo").value = tipo;

      document.getElementById("modalEditar").style.display = "block";
    }

    function cerrarModalEditar() {
      document.getElementById("modalEditar").style.display = "none";
    }

    window.onclick = function(event) {
      const modalAgregar = document.getElementById("modalAgregar");
      if (event.target == modalAgregar) {
        modalAgregar.style.display = "none";
      }
      const modalEditar = document.getElementById("modalEditar");
      if (event.target == modalEditar) {
        modalEditar.style.display = "none";
      }
    }
  </script>

</body>
</html>
=======
<?php
require_once 'db_connection.php';

$query = "SELECT * FROM usuarios";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ver Usuarios</title>
  <link rel="icon" type="image/jpeg" href="../../public/img/logo-removebg-preview.png">
  <link rel="stylesheet" href="../../css/styles_ver_usuarios.css">
</head>
<body>

  <div class="container">
    <h1>Lista de Usuarios</h1>
    <a href="#" class="btn-agregar" onclick="abrirModal()">Agregar Usuario</a>
    <a href="../../html/dashboard.html" class="btn-regreso">🔙 Regresar</a>

    <!-- MODAL AGREGAR -->
    <div id="modalAgregar" class="modal">
      <div class="modal-contenido">
        <span class="cerrar" onclick="cerrarModal()">&times;</span>
        <h2>Agregar Nuevo Usuario</h2>
        <form action="agregar_usuario.php" method="post">
          <input type="text" name="nombre_usuario" placeholder="Nombre completo" required>
          <input type="email" name="email_usuario" placeholder="Correo electrónico" required>
          <input type="password" name="password_usuario" placeholder="Contraseña" required>
          <select name="tipo_usuario" required>
            <option value="">Selecciona tipo de usuario</option>
            <option value="A">Administrador</option>
            <option value="E">Empleado</option>
          </select>
          <button type="submit">Guardar</button>
        </form>        
      </div>
    </div>

    <!-- MODAL EDITAR -->
    <div id="modalEditar" class="modal">
      <div class="modal-contenido">
        <span class="cerrar" onclick="cerrarModalEditar()">&times;</span>
        <h2>Editar Usuario</h2>
        <form action="editar_usuario.php" method="post">
          <input type="hidden" name="id_usuario" id="editar-id">
          <input type="text" name="nombre_usuario" id="editar-nombre" placeholder="Nombre completo" required>
          <input type="email" name="email_usuario" id="editar-email" placeholder="Correo electrónico" required>
          <input type="password" name="password_usuario" id="editar-password" placeholder="Contraseña (dejar vacío para no cambiar)">
          <select name="tipo_usuario" id="editar-tipo" required>
            <option value="A">Administrador</option>
            <option value="E">Empleado</option>
          </select>
          <button type="submit">Guardar Cambios</button>
        </form>
      </div>
    </div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Tipo</th>
          <th>Fecha de Registro</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id_usuarios'] ?></td>
            <td><?= htmlspecialchars($row['nombre_usuario']) ?></td>
            <td><?= htmlspecialchars($row['email_usuario']) ?></td>
            <td><?= $row['tipo_usuario'] === 'A' ? 'Administrador' : 'Empleado' ?></td>
            <td><?= $row['fecha_registro_usuario'] ?></td>
            <td>
              <button class="btn-editar" onclick="abrirModalEditar(
                <?= $row['id_usuarios'] ?>,
                '<?= htmlspecialchars($row['nombre_usuario'], ENT_QUOTES) ?>',
                '<?= htmlspecialchars($row['email_usuario'], ENT_QUOTES) ?>',
                '', // No enviamos la contraseña al editar para seguridad
                '<?= $row['tipo_usuario'] ?>'
              )">Editar</button>

              <form action="eliminar_usuario.php" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');" style="display:inline;">
                <input type="hidden" name="id" value="<?= $row['id_usuarios'] ?>">
                <button type="submit" class="btn-eliminar">Eliminar</button>
               </form>

            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <!-- JS para los modales -->
  <script>
    function abrirModal() {
      document.getElementById("modalAgregar").style.display = "block";
    }

    function cerrarModal() {
      document.getElementById("modalAgregar").style.display = "none";
    }

    function abrirModalEditar(id, nombre, email, password, tipo) {
      document.getElementById("editar-id").value = id;
      document.getElementById("editar-nombre").value = nombre;
      document.getElementById("editar-email").value = email;
      document.getElementById("editar-password").value = ''; // limpiar campo contraseña
      document.getElementById("editar-tipo").value = tipo;

      document.getElementById("modalEditar").style.display = "block";
    }

    function cerrarModalEditar() {
      document.getElementById("modalEditar").style.display = "none";
    }

    window.onclick = function(event) {
      const modalAgregar = document.getElementById("modalAgregar");
      if (event.target == modalAgregar) {
        modalAgregar.style.display = "none";
      }
      const modalEditar = document.getElementById("modalEditar");
      if (event.target == modalEditar) {
        modalEditar.style.display = "none";
      }
    }
  </script>

</body>
</html>
>>>>>>> 6e6044f0db3f2e69cd53519e0f16e656b79f9463
