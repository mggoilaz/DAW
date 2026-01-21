<?php
header("Content-Type: application/json");

// ---------- CONFIGURACIÓN ----------
$host = "localhost";
$dbname = "tienda";
$user = "postgres";
$password = "123456";

// Token simple
define("API_TOKEN", "123456");

// ---------- COMPROBAR MÉTODO ----------
$method = $_SERVER['REQUEST_METHOD'];

if ($method !== 'PUT' && $method !== 'DELETE') {
    http_response_code(405);
    echo json_encode([
        "error" => "Método no permitido"
    ]);
    exit;
}

// ---------- COMPROBAR TOKEN (GET) ----------
if (!isset($_GET['token']) || $_GET['token'] !== API_TOKEN) {
    http_response_code(401);
    echo json_encode([
        "error" => "Token inválido o no proporcionado"
    ]);
    exit;
}

// ---------- CONEXIÓN ----------
try {
    $dsn = "pgsql:host=$host;dbname=$dbname";
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "error" => "Error de conexión"
    ]);
    exit;
}

// ---------- DELETE ----------
if ($method === 'DELETE') {

    if (!isset($_GET['id'])) {
        echo json_encode([
            "error" => "Falta el id del producto"
        ]);
        exit;
    }

    $id = (int) $_GET['id'];

    try {
        $stmt = $dbh->prepare("DELETE FROM producto WHERE id = :id");
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            echo json_encode([
                "error" => "No existe ningún producto con ese id"
            ]);
        } else {
            echo json_encode([
                "mensaje" => "Producto eliminado correctamente"
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            "error" => "Error al eliminar el producto"
        ]);
    }

    exit;
}

// ---------- PUT ----------
if ($method === 'PUT') {

    if (
        !isset($_GET['id']) ||
        !isset($_GET['nombre']) ||
        !isset($_GET['precio']) ||
        !isset($_GET['id_fabricante'])
    ) {
        echo json_encode([
            "error" => "Faltan parámetros"
        ]);
        exit;
    }

    $id = (int) $_GET['id'];
    $nombre = $_GET['nombre'];
    $precio = $_GET['precio'];
    $id_fabricante = (int) $_GET['id_fabricante'];

    try {
        $sql = "
            UPDATE producto
            SET nombre = :nombre,
                precio = :precio,
                id_fabricante = :id_fabricante
            WHERE id = :id
        ";

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":nombre", $nombre);
        $stmt->bindValue(":precio", $precio);
        $stmt->bindValue(":id_fabricante", $id_fabricante, PDO::PARAM_INT);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            echo json_encode([
                "error" => "No se ha modificado ningún producto (id inexistente)"
            ]);
        } else {
            echo json_encode([
                "mensaje" => "Producto actualizado correctamente"
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            "error" => "Error al actualizar el producto"
        ]);
    }

    exit;
}
