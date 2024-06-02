<?php

class DataBaseConnection
{

    private $db;

    public function openDBConnection() : PDO
    {
       try {

        $db = new PDO('mysql:host=db4free.net;dbname=testprojekt', 'testprojekt', 'testprojekt', [

        ]);

       } catch(\PDOException $e){
        throw new \PDOException($e->getMessage(), $e->getCode());
       }

       return $db;

    }

    public function closeDBConnection()
    {
       $this->db = null;
    }




}


$dataBase = new DataBaseConnection();
$dataBase->openDBConnection();
