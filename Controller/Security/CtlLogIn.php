<?php

/*IMPORTS*/
require '../../DTO/Security/LogInDTO.php';
require '../../DAO/Security/LogInDAO.php';

/*RECEPCION DE DATOS*/
$usuario = (isset($_POST['user']) ? $_POST['user'] : "");
$password = (isset($_POST['password']) ? $_POST['password'] : "");

/*DEFINICION DE OBJETOS*/
$obj = new LogInDTO($usuario, $password);
$conex = new LogInDAO();
//
///* CONTROL DE ACCIONES */
$conex->SignIn($obj);

