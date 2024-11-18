<?php
declare(strict_types=1);

namespace App\Service;

use App\Models\Task;
use PDO;

class TaskService
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function createTask(array $data): bool
    {
        $task = new Task(
            $this->db,
            $data['title'],
            $data['description'] ?? null,
            $data['status'] ?? 'pending',
            $data['creator_id']
        );
        return $task->create();
    }

    public function updateTask(int $taskId, array $data): bool
    {
        $task = new Task($this->db, $data['title'], $data['description'], $data['status'], $data['creator_id']);
        $task->setId($taskId);
        return $task->update();
    }

    public function deleteTask(int $taskId): bool
    {
        $task = new Task($this->db, '', null, '', 0);
        $task->setId($taskId);
        return $task->delete();
    }

    public function getTasksByUser(int $userId): array
    {
        $sql = "SELECT * FROM tasks WHERE creator_id = :user_id OR assigned_to_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
