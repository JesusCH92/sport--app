<?php

declare(strict_types=1);

namespace App\Common\Infrastructure;

use Exception;
use PDO;
use PDOException;

abstract class DbConnector
{
    private PDO $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:dbname=database;host=mariadb', 'user', 'password');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception('Error al conectar la app: ' . $e->getMessage());
        }
    }

    public function pdo(): PDO
    {
        return $this->pdo;
    }
}