<?php
namespace App;

use PDO;
use Dotenv\Dotenv;

class UserController {
    private PDO $db;

    public function __construct() {
        // Charger le fichier .env à partir de la racine du projet
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        // Lire les variables d'environnement avec fallback
        $host = $_ENV['DB_HOST'] ?? 'mysql';
        $port = $_ENV['DB_PORT'] ?? '3306';
        $name = $_ENV['DB_NAME'] ?? 'cruddb';
        $user = $_ENV['DB_USER'] ?? 'root';
        $pass = $_ENV['DB_PASS'] ?? 'root';

        $dsn = "mysql:host=$host;port=$port;dbname=$name;charset=utf8mb4";

        // Connexion PDO avec gestion d’erreur
        $this->db = new PDO($dsn, $user, $pass);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAllUsers(): string {
        $stmt = $this->db->query("SELECT * FROM users");
        return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getUser(int $id): string {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return json_encode($stmt->fetch(PDO::FETCH_ASSOC));
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
        return json_encode([
    "success" => true,
    "message" => "User with ID $id deleted successfully.",
    "id" => $id
]);

    }
}
