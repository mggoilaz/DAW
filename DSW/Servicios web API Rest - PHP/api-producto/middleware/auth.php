<?php
function validarToken() {
    $headers = getallheaders();

    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        echo json_encode(["error" => "Token no proporcionado"]);
        exit();
    }

    $token = str_replace("Bearer ", "", $headers['Authorization']);

    if ($token !== "miclave123") {
        http_response_code(401);
        echo json_encode(["error" => "Token inválido"]);
        exit();
    }
}