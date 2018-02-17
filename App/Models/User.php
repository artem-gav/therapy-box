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
    public static function auth($login, $password) {
        $db = static::getDB();

        $stmt = $db->prepare("SELECT * FROM users WHERE login = :login AND password = :password LIMIT 1");

        $stmt->execute([
            'login' => $login,
            'password' => md5(md5($password)),
        ]);

        return !!$stmt->rowCount();
    }

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
