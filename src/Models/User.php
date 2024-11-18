<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

class User
{
    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private PDO $db;

    public function __construct(PDO $db, string $username, string $email, string $password)
    {
        $this->db = $db;
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function register(): bool
    {
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':username' => $this->username,
            ':email' => $this->email,
            ':password' => $this->password,
        ]);
    }

    public function login(string $username, string $password): bool
    {
        $sql = "SELECT id, password FROM users WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $this->id = (int)$user['id'];
            return true;
        }
        return false;
    }

    public function logout(): void
    {
        session_destroy();
    }

    public function changePassword(string $newPassword): bool
    {
        $this->password = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':password' => $this->password,
            ':id' => $this->id,
        ]);
    }

    public function getTasks(): array
    {
        $sql = "SELECT * FROM tasks WHERE creator_id = :id OR assigned_to_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
