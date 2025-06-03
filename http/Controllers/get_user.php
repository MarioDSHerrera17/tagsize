<<<<<<< HEAD
<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION["usuario_nombre"])) {
    echo json_encode(["usuario" => $_SESSION["usuario_nombre"]]);
} else {
    echo json_encode(["usuario" => null]);
}
?>
=======
<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION["usuario_nombre"])) {
    echo json_encode(["usuario" => $_SESSION["usuario_nombre"]]);
} else {
    echo json_encode(["usuario" => null]);
}
?>
>>>>>>> 6e6044f0db3f2e69cd53519e0f16e656b79f9463
