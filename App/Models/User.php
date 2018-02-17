<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class User extends \Core\Model
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT id, login FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = static::getDB();

        if(self::checkEmail($data['email'])) {
            throw new \Exception('Email is already exist');
        }

        $stmt = $db->prepare("INSERT INTO users (login, email, password, picture) VALUES (:login, :email, :password, :picture)");

        $stmt->execute([
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => md5(md5($data['password'])),
            'picture' => $data['picture'],
        ]);
    }

    public static function createValidation($data) {
        if(empty($data['login']) || empty($data['password']) || empty($data['confirm_password']) || empty($data['email']) || empty($data['picture'])) {
            throw new \Exception('Not all parameters have been transferred');
        } elseif($data['password'] !== $data['confirm_password']) {
            throw new \Exception('Confirmation password differs from password');
        }
    }

    private static function checkEmail($email) {
        $db = static::getDB();

        $stmt = $db->prepare('SELECT * FROM users WHERE email =? LIMIT 1');
        $stmt->execute([$email]);

        if($stmt->rowCount()) {
            return true;
        }

        return false;
    }
}
