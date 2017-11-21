<?php
class Usuario {
    // Atributos
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;
    
    // Getters and Setters
    public function getIdusuario() {
        return $this->idusuario;
    }
    public function setIdusuario($id) {
        $this->idusuario = $id;
    }
    public function getDeslogin() {
        return $this->deslogin;
    }
    public function setDeslogin($login) {
        $this->deslogin = $login;
    }
    public function getDessenha() {
        return $this->dessenha;
    }
    public function setDessenha($senha) {
        $this->dessenha = $senha;
    }
    public function getDtcadastro() {
        return $this->dtcadastro;
    }
    public function setDtcadastro($data) {
        $this->dtcadastro = $data;
    }
    
    // Metodos
    public function loadById($id) {
        $sql = new Sql();
       
        $resultado = $sql->select("SELECT * FROM tb_usuario WHERE id = :ID", array(
            ":ID"=>$id
        ));
        if(count($resultado) > 0) {
            $this->setData($resultado[0]);
        }
    }
    
    // Busca uma lista de usuarios
    public static function getList() {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuario ORDER BY id ASC");
    }
    
    // Search for login
    public static function search($login) {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuario WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
            ':SEARCH'=>"%".$login."%"
        ));
    }
    
    // Traz um usuario baseado no login e senha
    public function login($login, $pass) {
        $sql = new Sql();
        $resultado = $sql->select("SELECT * FROM tb_usuario WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(
            ":LOGIN"=>$login,
            ":SENHA"=>$pass
        ));
        if(count($resultado) > 0) {
            $this->setData($resultado[0]);
        } else {
            throw new Exception("Erro ao processar a requisição", 100);
        }
    }
    
    // Metodo que popula os atributos
    public function setData($data) {
        $this->setIdusuario($data['id']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));
    }

    // Metodo toString | Devolve um Json Array quando é dado um echo no OBJ
    public function __toString() {
        return json_encode(array(
            "id"=> $this->getIdusuario(),
            "deslogin"=> $this->getDeslogin(),
            "dessenha"=> $this->getDessenha(),
            "dtcadastro"=> $this->getDtcadastro()->format("d/m/Y")
        ));
    }
    
    // Metodo de INSERT
    public function insert() {
        $sql = new Sql();
        $resultado = $sql->select("CALL sp_usuario_insert(:LOGIN, :SENHA)", array(
            ":LOGIN"=> $this->getDeslogin(),
            ":SENHA"=> $this->getDessenha()
        ));
        if(count($resultado) > 0) {
            $this->setData($resultado[0]);
        }
    }
    
    // Metodo update
    public function update($login, $pass) {
        $this->setDeslogin($login);
        $this->setDessenha($pass);
        $sql = new Sql();
        $sql->query("UPDATE tb_usuario SET deslogin = :LOGIN, dessenha = :SENHA WHERE id = :ID", array(
            ":LOGIN"=> $this->getDeslogin(),
            ":SENHA"=> $this->getDessenha(),
            ":ID"=> $this->getIdusuario()
        ));
    }
    
    // Metodo DELETE
    public function delete() {
        $sql = new Sql();
        $sql->query("DELETE FROM tb_usuario WHERE id = :ID", array(
            ":ID"=>$this->getIdusuario()
        ));
    }
    
    // Este construtor já seta os valores de login e senha assim que a classe é instancida
    public function __construct($login = "", $senha = "") { // Caso não seja passado parametros, serão passados os valores vazios.
        $this->setDeslogin($login);
        $this->setDessenha($senha);
    }
}