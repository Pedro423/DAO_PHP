<?php
class Sql extends PDO { // Herdando atributos e metodos da claasse PDO.
    // Atributos
    private $con;
    private $dsn = "mysql:dbname=db_php-seven;host=localhost";
    private $user = "root";
    private $pass = "";
    
    // Construtor
    public function __construct() { // Construtor que abre a conexão assim que a classe é instanciada.
        $this->con = new PDO($this->dsn, $this->user, $this->pass);
    }
    
    // Metodos
    private function setParams($statement, $parameters = array()) {
        foreach($parameters as $key => $value) {
            $this->setParam($statement, $key, $value);
        }
    }
    
    private function setParam($statement, $key, $value) {
        $statement->bindParam($key, $value);
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