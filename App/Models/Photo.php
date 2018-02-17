<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Photo extends \Core\Model
{
    public static function getAll($limit = null)
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT id, photo FROM photos' . ($limit ? " LIMIT $limit" : ''));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = static::getDB();

        $stmt = $db->prepare("INSERT INTO photos (photo) VALUES (:photo)");

        $stmt->execute([
            'photo' => $data['photo'],
        ]);
    }
}
