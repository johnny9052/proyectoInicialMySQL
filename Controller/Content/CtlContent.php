<?php

require '../../DTO/Security/LogInDTO.php';
require '../../DAO/Security/LogInDAO.php';


$page = (isset($_GET['page']) ? $_GET['page'] : "");


$obj = new LogInDTO($usuario, $password);
$conex = new loguinDAO();

$conex->SignIn($obj);
