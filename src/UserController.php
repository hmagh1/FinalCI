<?php
namespace App;

class UserController {
    private \PDO $db;

    public function __construct() {
        $host = getenv('DB_HOST') ?: 'mysql'; // Default to 'mysql' for Docker
        $user = getenv('DB_USER') ?: 'root';
        $pass = getenv('DB_PASS') ?: 'root';
        $name = getenv('DB_NAME') ?: 'cruddb';

        $dsn = "mysql:host=$host;port=3306;dbname=$name;charset=utf8mb4";
        $this->db = new \PDO($dsn, $user, $pass);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getAllUsers(): string {
        $stmt = $this->db->query("SELECT * FROM users");
        return json_encode($stmt->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function getUser(int $id): string {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return json_encode($stmt->fetch(\PDO::FETCH_ASSOC));
    }

    public function createUser(string $name, string $email): string {
        $stmt = $this->db->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        $stmt->execute([$name, $email]);
        return json_encode([
            "id" => $this->db->lastInsertId(),
            "name" => $name,
            "email" => $email
        ]);
    }

    public function updateUser(int $id, string $name, string $email): string {
        $stmt = $this->db->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->execute([$name, $email, $id]);
        return json_encode(["id" => $id, "name" => $name, "email" => $email]);
    }

    public function deleteUser(int $id): string {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return json_encode(["deleted" => true, "id" => $id]);
    }
}
