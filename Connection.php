<?php

class Connection {
 
    private $db;
    private $stmt;

    public function __construct()
    {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $dbname = "restapi";
        $pbo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

        $pbo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
        $pbo->setAttribute(
            PDO::ATTR_DEFAULT_FETCH_MODE,
            PDO::FETCH_ASSOC
        );

        $this->db = $pbo;
    }
    public function execute($query, $args)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute($args);
        $this->stmt = $stmt;
    }

    public function fetch($query, $args){
        $this->execute($query, $args);
        return $this->stmt->fetch();
    }
    public function fetchALL($query, $args){
        $this->execute($query, $args);
        return $this->stmt->fetchALL();
    }
}
