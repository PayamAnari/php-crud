<?php

class Database
{

    // Database Properties.

    private $host = "localhost";
    private $db_name = "php-crud";
    private $username = "root";
    private $password = "2219499";
    private $connection = null;

    // Function for Database Connection.

    public function connect()
    {

        try {
            $this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username,
                $this->password,
            );
            $this->connection->exec("set names utf8");
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die("Unable to connect to the database. Please try again later.");
        }

        return $this->connection;
    }

}
