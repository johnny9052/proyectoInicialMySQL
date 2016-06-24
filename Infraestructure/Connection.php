<?php

class Connection {

    private $userbd;
    private $passworddb;
    private $database;
    private $port;
    private $host;
    private $connect;

//    public function connect() {
//        $this->userbd = "postgres";
//        $this->passworddb = "admin";
//        $this->database = "proyectoInicial";
//        $this->port = 5432;
//        $this->host = "localhost";
//        $this->chainConect = "host=$this->host port=$this->port dbname=$this->database user=$this->userbd password=$this->passworddb";
//        $this->connect = pg_connect($this->chainConect) or die("Error al realizar la conexion");
//    }


    public function connect() {
        $this->userbd = "root";
        $this->passworddb = "admin";
        $this->database = "proyectoInicial";
        $this->port = 5432;
        $this->host = "localhost";

        try {
            $this->connect = new PDO("mysql:host=$this->host;dbname=$this->database", $this->userbd, $this->passworddb);
            // set the PDO error mode to exception
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnect() {
        return $this->connect;
    }

}
