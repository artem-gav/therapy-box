<?php

namespace App\Models;

use PDO;

class Task extends \Core\Model
{
    public static function getAll($limit = null)
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT id, description, checked FROM tasks' . ($limit ? " LIMIT $limit" : ''));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = static::getDB();

        $stmt = $db->prepare("INSERT INTO tasks (description, checked) VALUES (:description, :checked)");

        $stmt->execute([
            'description' => $data['description'],
            'checked' => $data['checked'],
        ]);
    }

    public static function update($data) {
        $db = static::getDB();

        $stmt = $db->prepare("UPDATE tasks SET {$data['name']} = :val WHERE id = :id");

        $stmt->execute([
            'id' => $data['id'],
            'val' => $data['value'],
        ]);
    }
}
