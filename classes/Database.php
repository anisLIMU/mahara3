<?php

namespace Maharah\Classes;

use PDO;

use Exception;

final class Database
{
    protected $pdo;

    protected array $config = [];

    public function __construct()
    {
        // Load configuration
        $this->loadConfig();

        // Connect to database
        try {
            $this->pdo = new PDO(
                'mysql:host=' . $this->config['host'] . ';dbname=' . $this->config['database'],
                $this->config['username'],
                $this->config['password']
            );
        } catch (Exception $e) {
            throw new Exception('Could not connect to database, check your config.php file');
        }
    }

    public function getRecord(string $sql, array $params = [])
    {
        $sth = $this->exec($sql, $params);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function getRecords(string $sql, array $params = [])
    {
        $sth = $this->exec($sql, $params);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    private function exec(string $sql, array $params = [])
    {
        $sth = $this->pdo->prepare($sql);
        foreach ($params as $key => $value) {
            $sth->bindValue(':' . $key, $value);
        }
        $sth->execute();

        return $sth;
    }

    private function loadConfig(): void
    { 
        $this->config = require __DIR__ . '/../config.php';
    }
}