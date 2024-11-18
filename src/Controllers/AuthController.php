<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use App\Service\UserService;
use PDO;

class AuthController
{
    private PDO $db;
    private UserService $userService;

    public function __construct(PDO $db, UserService $userService)
    {
        $this->db = $db;
        $this->userService = $userService;
    }

    public function register(array $data): void
    {
        try {
            $this->userService->register($data);
            echo "User registered successfully!";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function login(array $data): void
    {
        try {
            $userId = $this->userService->login($data['username'], $data['password']);
            $_SESSION['user_id'] = $userId;
            echo "Login successful!";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function changePassword(int $userId, string $newPassword): void
    {
        try {
            $this->userService->changePassword($userId, $newPassword);
            echo "Password updated successfully!";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
        echo "User logged out successfully!";
    }
}
