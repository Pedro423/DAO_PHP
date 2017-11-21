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
            $row = $resultado[0];
            
            $this->setIdusuario($row['id']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime($row['dtcadastro']));
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
            $row = $resultado[0];
            
            $this->setIdusuario($row['id']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime($row['dtcadastro']));
        } else {
            throw new Exception("Erro ao processar a requisição", 100);
        }
    }

    // Metodo toString
    public function __toString() {
        return json_encode(array(
            "id"=> $this->getIdusuario(),
            "deslogin"=> $this->getDeslogin(),
            "dessenha"=> $this->getDessenha(),
            "dtcadastro"=> $this->getDtcadastro()->format("d/m/Y")
        ));
    }
}