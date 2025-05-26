<?php

namespace App\Core;

class Database
{
    public static function connect()
    {
        return new \PDO('mysql:host=db;dbname=erp_php_mvc', 'root', 'root', [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
    }
}
