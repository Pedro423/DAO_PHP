<?php
require_once('./config.php');

// Utilisando o metodo da classe sql.
//$sql = new Sql();
//$usuarios = $sql->select("select * from tb_usuario where id = 3");
//echo json_encode($usuarios);

// Consumindo a classe Usuario
$usuario = new Usuario();
$usuario->loadById(4);
echo $usuario;