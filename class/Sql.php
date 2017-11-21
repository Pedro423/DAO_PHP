<?php
class Sql extends PDO { // Extendi a classe PDO para acessar os atributos e metodos.
    private $con;
    private $dsn = "mysql:dbname=db_php-seven;host=localhost";
    private $user = "root";
    private $pass = "";
    
    public function __construct() {
        $this->con = new PDO($this->dsn, $this->user, $this->pass);
    }
    
    private function setParams($statment, $parameters = array()) {
        foreach($parameters as $key => $value) {
            $this->setParam($key, $value);
        }
    }
    
    private function setParam($statment, $key, $value) {
        $statment->bindParam($key, $value);
    }
    
    public function query($rawQuery, $params = array()) {
        $stm = $this->con->prepare($rawQuery);
        $this->setParams($stm, $params);
        $stm->execute();
        return $stm;
    }
    
    public function select($rawQuery, $params = array()):array {
        $stm = $this->query($rawQuery, $params);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
}
