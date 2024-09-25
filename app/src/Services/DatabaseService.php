<?php

namespace App\Services;

use PDO;
use PDOException;

class DatabaseService
{
    /**
     * PDO instance
     *
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * Database configuration
     *
     * @var array
     */
    protected array $config;

    /**
     * Database connection status
     *
     * @var bool
     */
    private bool $connected = false;

    public function __construct()
    {
        $this->config = require_once(__DIR__ . '/../../config/db.php');
    }

    /**
     * Connect to the database
     *
     * @return PDO
     */
    public function connect(): PDO
    {
        if ($this->connected) {
            return $this->pdo;
        }

        $host = $this->config['host'];
        $username = $this->config['username'];
        $password = $this->config['password'];
        $database = $this->config['database'];

        $dsn = "mysql:host=$host;dbname=$database";
        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("DB connection failed: " . $e->getMessage() . PHP_EOL);
        }

        $this->connected = true;
        return $this->pdo;
    }
}