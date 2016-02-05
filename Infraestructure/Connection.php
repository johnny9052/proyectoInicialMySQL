<?php

class Connection {

    private $userbd;
    private $passworddb;
    private $database;
    private $port;
    private $host;
    private $chainConect;
    private $connect;

    public function connect() {
        $this->userbd = "postgres";
        $this->passworddb = "admin";
        $this->database = "proyectoInicial";
        $this->port = 5432;
        $this->host = "localhost";
        $this->chainConect = "host=$this->host port=$this->port dbname=$this->database user=$this->userbd password=$this->passworddb";
        $this->connect = pg_connect($this->chainConect) or die("Error al realizar la conexion");
    }

    public function getConnect() {
        return $this->connect;
    }

    
}

