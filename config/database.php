<?php

namespace Config;

use PDO;
use PDOException;
use Exception;

require_once 'env.inc';

class Database
{
    private $connection;
    private static $instance = null;

    /**
     *  Establish Connection
     */
    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->exec("set names " . DB_CHAR);
        } catch (PDOException $exception) {
            error_log("Connection error: " . $exception->getMessage());
            throw new Exception("Database connection failed.");
        }
    }

    /**
     * Return Connection Instance
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->connection;
    }
}