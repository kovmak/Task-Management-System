<?php
declare(strict_types=1);

namespace App\Service;

use App\Models\User;
use PDO;

class UserService
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function register(array $data): bool
    {
        $user = new User($this->db, $data['username'], $data['email'], $data['password']);
        return $user->register();
    }

    public function login(string $username, string $password): int
    {
        $user = new User($this->db, $username, '', '');
        if ($user->login($username, $password)) {
            return $user->getId();
        }
        throw new \Exception('Invalid username or password');
    }

    public function changePassword(int $userId, string $newPassword): bool
    {
        $user = new User($this->db, '', '', '');
        $user->setId($userId);
        return $user->changePassword($newPassword);
    }
}
