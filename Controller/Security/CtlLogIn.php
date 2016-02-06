<?php

require '../../DTO/Security/LogInDTO.php';
require '../../DAO/Security/LogInDAO.php';

$usuario = (isset($_POST['user']) ? $_POST['user'] : "");
$password = (isset($_POST['password']) ? $_POST['password'] : "");


$obj = new LogInDTO($usuario, $password);
$conex = new loguinDAO();

$conex->SignIn($obj);

