<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

class Task
{
    private int $id;
    private string $title;
    private ?string $description;
    private string $status;
    private int $creatorId;
    private ?int $assignedToId;
    private \DateTimeImmutable $createdAt;
    private \DateTimeImmutable $updatedAt;
    private PDO $db;

    public function __construct(
        PDO $db,
        string $title,
        ?string $description,
        string $status,
        int $creatorId,
        ?int $assignedToId = null
    ) {
        $this->db = $db;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->creatorId = $creatorId;
        $this->assignedToId = $assignedToId;
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function create(): bool
    {
        $sql = "INSERT INTO tasks (title, description, status, creator_id, assigned_to_id, created_at, updated_at)
                VALUES (:title, :description, :status, :creator_id, :assigned_to_id, :created_at, :updated_at)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':title' => $this->title,
            ':description' => $this->description,
            ':status' => $this->status,
            ':creator_id' => $this->creatorId,
            ':assigned_to_id' => $this->assignedToId,
            ':created_at' => $this->createdAt->format('Y-m-d H:i:s'),
            ':updated_at' => $this->updatedAt->format('Y-m-d H:i:s'),
        ]);
    }

    public function update(): bool
    {
        $this->updatedAt = new \DateTimeImmutable();
        $sql = "UPDATE tasks SET title = :title, description = :description, status = :status, updated_at = :updated_at 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':title' => $this->title,
            ':description' => $this->description,
            ':status' => $this->status,
            ':updated_at' => $this->updatedAt->format('Y-m-d H:i:s'),
            ':id' => $this->id,
        ]);
    }

    public function delete(): bool
    {
        $sql = "DELETE FROM tasks WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $this->id]);
    }

    public function assignTo(int $userId): bool
    {
        $this->assignedToId = $userId;
        $sql = "UPDATE tasks SET assigned_to_id = :assigned_to_id WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':assigned_to_id' => $userId,
            ':id' => $this->id,
        ]);
    }

    public function changeStatus(string $newStatus): bool
    {
        $this->status = $newStatus;
        $sql = "UPDATE tasks SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':status' => $newStatus,
            ':id' => $this->id,
        ]);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCreatorId(): int
    {
        return $this->creatorId;
    }

    public function getAssignedToId(): ?int
    {
        return $this->assignedToId;
    }
}
