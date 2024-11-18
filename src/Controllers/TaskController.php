<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Service\TaskService;
use PDO;

class TaskController
{
    private PDO $db;
    private TaskService $taskService;

    public function __construct(PDO $db, TaskService $taskService)
    {
        $this->db = $db;
        $this->taskService = $taskService;
    }

    public function create(array $data): void
    {
        try {
            $this->taskService->createTask($data);
            echo "Task created successfully!";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update(int $taskId, array $data): void
    {
        try {
            $this->taskService->updateTask($taskId, $data);
            echo "Task updated successfully!";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delete(int $taskId): void
    {
        try {
            $this->taskService->deleteTask($taskId);
            echo "Task deleted successfully!";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getTasksByUser(int $userId): void
    {
        try {
            $tasks = $this->taskService->getTasksByUser($userId);
            echo json_encode($tasks);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
