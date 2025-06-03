<<<<<<< HEAD
<?php
session_start();
include "db_connection.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        printf(json_encode(["success" => false, "message" => "❌ Todos los campos son obligatorios."]));
        exit;
    }

    $sql = "SELECT id_usuarios, nombre_usuario, email_usuario, password_usuario, tipo_usuario FROM usuarios WHERE email_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();

        if ($password == $usuario["password_usuario"]) {
            $_SESSION["usuario_id"] = $usuario["id_usuarios"];
            $_SESSION["usuario_nombre"] = $usuario["nombre_usuario"];
            $_SESSION["usuario_tipo"] = $usuario["tipo_usuario"];

            //echo json_encode(["success" => true]);
           printf(json_encode(["success" => true]));

        } else {
            printf(json_encode(["success" => false, "message" => "❌ Contraseña incorrecta."]));
        }
    } else {
        printf(json_encode(["success" => false, "message" => "❌ Usuario no encontrado."]));
    }

    $stmt->close();
}
$conn->close();
=======
<?php
session_start();
include "db_connection.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        printf(json_encode(["success" => false, "message" => "❌ Todos los campos son obligatorios."]));
        exit;
    }

    $sql = "SELECT id_usuarios, nombre_usuario, email_usuario, password_usuario, tipo_usuario FROM usuarios WHERE email_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();

        if ($password == $usuario["password_usuario"]) {
            $_SESSION["usuario_id"] = $usuario["id_usuarios"];
            $_SESSION["usuario_nombre"] = $usuario["nombre_usuario"];
            $_SESSION["usuario_tipo"] = $usuario["tipo_usuario"];

            //echo json_encode(["success" => true]);
           printf(json_encode(["success" => true]));

        } else {
            printf(json_encode(["success" => false, "message" => "❌ Contraseña incorrecta."]));
        }
    } else {
        printf(json_encode(["success" => false, "message" => "❌ Usuario no encontrado."]));
    }

    $stmt->close();
}
$conn->close();
>>>>>>> 6e6044f0db3f2e69cd53519e0f16e656b79f9463
?>