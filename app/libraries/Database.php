<?php

class Database
{
    private $dbHandler;
    private $statement;

    public function __construct()
    {
        $conn = 'mysql:host=' . DB_HOST . ';dbname='. DB_NAME . ';charset=UTF8';

        try {
            $this->dbHandler = new PDO($conn, DB_USER, DB_PASS);

            if ($this->dbHandler) {
                // echo "Verbinding met de database is gelukt";
            } else {
                echo "Interne server-error";
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function query($sql)
    {
        $this->statement = $this->dbHandler->prepare($sql);
    }

    public function execute()
    {
        return $this->statement->execute();
    }

    public function resultSet()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function single()
    {
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function bind($parameter, $value, $type) 
    {
        $this->statement->bindValue($parameter, $value ,$type);
    }


}