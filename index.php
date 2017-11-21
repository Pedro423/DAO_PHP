<?php
require_once('./config.php');

// Usando o metodo da classe sql
//$sql = new Sql();
//$usuarios = $sql->select("select * from tb_usuario where id = 3");
//echo json_encode($usuarios);

// Consumindo a classe Usuario
//$usuario = new Usuario();
//$usuario->loadById(4);
//echo $usuario;

//$resultado = Usuario::getList();
//echo json_encode($resultado);

// Carrega uma lista de usuarios buscando pelo login
//$search = Usuario::search("a");
//echo json_encode($search);

$usuario = new Usuario();
$usuario->login("pedro", "123456");
echo $usuario;