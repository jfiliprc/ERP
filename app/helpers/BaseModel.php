<?php

namespace App\Helpers;

use App\Core\Database;
use PDO;

abstract class BaseModel
{
    protected static $table;

    protected static function getConnection()
    {
        return Database::connect();
    }

    public static function all()
    {
        $pdo = self::getConnection();
        $stmt = $pdo->query("SELECT * FROM " . static::$table);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM " . static::$table . " WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $pdo = self::getConnection();
        $fields = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $stmt = $pdo->prepare("INSERT INTO " . static::$table . " ($fields) VALUES ($placeholders)");
        $stmt->execute(array_values($data));
        return $pdo->lastInsertId();
    }

    public static function update($id, $data)
    {
        $pdo = self::getConnection();
        $fields = implode(' = ?, ', array_keys($data)) . ' = ?';

        $stmt = $pdo->prepare("UPDATE " . static::$table . " SET $fields WHERE id = ?");
        $stmt->execute(array_merge(array_values($data), [$id]));
    }

    public static function delete($id)
    {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("DELETE FROM " . static::$table . " WHERE id = ?");
        $stmt->execute([$id]);
    }
}
