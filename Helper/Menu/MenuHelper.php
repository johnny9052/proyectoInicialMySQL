<?php

require 'DTO/Menu/MenuDTO.php';
require 'DAO/Menu/MenuDAO.php';


//session_start();
$rol = $_SESSION["TypeUser"];

$obj = new MenuDTO($rol);
$conex = new MenuDAO();

$conex->LoadMenu($obj);

