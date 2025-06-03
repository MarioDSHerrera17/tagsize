<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION["usuario_nombre"])) {
    echo json_encode(["usuario" => $_SESSION["usuario_nombre"]]);
} else {
    echo json_encode(["usuario" => null]);
}
?>
