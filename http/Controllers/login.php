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

    $sql = "SELECT id, nombre, email, password, tipo_usuario FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();

        if ($password == $usuario["password"]) {
            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["usuario_nombre"] = $usuario["nombre"];
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
?>