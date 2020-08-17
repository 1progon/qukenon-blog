<?php


namespace App\Models\User\Classes;


use PDO;
use PDOException;

class Database
{

    private $host = DB_HOST;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $database = DB_DATABASE;
    public PDO $pdo;

    public function __construct()
    {
        $this->pdo = $this->connect();
    }

    private function connect()
    {
        try {
            $conn = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->database . '',
                $this->username,
                $this->password
            );

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return null;
    }


}
