<?php
class Database {
    private $host = "localhost";
    private $db_name = "tienda";
    private $username = "postgres";
    private $password = "123456";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "pgsql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            http_response_code(500);
            echo json_encode(["error" => "Error de conexión"]);
            exit();
        }

        return $this->conn;
    }
}