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