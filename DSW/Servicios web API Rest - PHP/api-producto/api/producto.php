<?php
header("Content-Type: application/json");

require_once "../config/database.php";
require_once "../middleware/auth.php";


validarToken();

$database = new Database();
$db = $database->getConnection();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

    case "PUT":
        parse_str(file_get_contents("php://input"), $data);

        if (!isset($data['id'], $data['nombre'], $data['precio'], $data['id_fabricante'])) {
            http_response_code(400);
            echo json_encode(["error" => "Datos incompletos"]);
            exit();
        }

        $query = "UPDATE producto 
                  SET nombre = :nombre, precio = :precio, id_fabricante = :id_fabricante 
                  WHERE id = :id";

        $stmt = $db->prepare($query);

        $stmt->bindParam(":id", $data['id']);
        $stmt->bindParam(":nombre", $data['nombre']);
        $stmt->bindParam(":precio", $data['precio']);
        $stmt->bindParam(":id_fabricante", $data['id_fabricante']);

        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(["mensaje" => "Producto actualizado correctamente"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "No se pudo actualizar"]);
        }
        break;

    case "DELETE":

        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(["error" => "ID no proporcionado"]);
            exit();
        }

        $query = "DELETE FROM producto WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":id", $_GET['id']);

        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(["mensaje" => "Producto eliminado correctamente"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "No se pudo eliminar"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido"]);
        break;
}