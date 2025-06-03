<<<<<<< HEAD
<?php
$host = "localhost";  // Servidor de MySQL
$user = "root";       // Usuario de MySQL (cambia si usas otro)
$password = "root";       // Contraseña de MySQL (déjala vacía si no configuraste una)
$dbname = "tennis2";   // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
} 
?>
=======
<?php
$host = "localhost";  // Servidor de MySQL
$user = "root";       // Usuario de MySQL (cambia si usas otro)
$password = "root";       // Contraseña de MySQL (déjala vacía si no configuraste una)
$dbname = "tennis2";   // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
} 
?>
>>>>>>> 6e6044f0db3f2e69cd53519e0f16e656b79f9463
