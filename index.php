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

//$usuario = new Usuario();
//$usuario->login("pedro", "123456");
//echo $usuario;

// Grava um usuario usando uma procedure e já retorna o ID do usuario cadastrado
//$aluno = new Usuario();
//$aluno->setDeslogin("renata"); // Passando os valores de insert para os setters
//$aluno->setDessenha("123456"); // Passando os valores de insert para os setters
//$aluno->insert();
//echo $aluno;

// Grava um usuario usando uma procedure e já retorna o ID do usuario cadastrado
//$aluno = new Usuario("rebeca", "654321"); // Passando parametros para o construtor da classe
//$aluno->insert();
//echo $aluno;

// Fazendo UPDATE dos dados passando os novos valores por parametro
$user = new Usuario(); // Criação do OBJ para utilizar o metodo update
$user->loadById(10); // Carregando o id do usuário que será atualizado
$user->update("Daniela", "112233"); // Chamando o metodo update e passando os novos valores por parametro
echo $user;


