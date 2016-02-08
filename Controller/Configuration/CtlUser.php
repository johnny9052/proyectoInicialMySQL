<?php

/* IMPORTS */
require '../../DTO/Configuration/UserDTO.php';
require '../../DAO/Configuration/UserDAO.php';
include '../../Helper/Action/Action.php';

/* RECEPCION DE DATOS */
$action = (isset($_POST['action']) ? $_POST['action'] : "");
$id = (isset($_POST['id']) ? $_POST['id'] : "");
$firstName = (isset($_POST['firstName']) ? $_POST['firstName'] : "");
$secondName = (isset($_POST['secondName']) ? $_POST['secondName'] : "");
$firstLastName = (isset($_POST['firstLastName']) ? $_POST['firstLastName'] : "");
$secondLastName = (isset($_POST['secondLastName']) ? $_POST['secondLastName'] : "");
$user = (isset($_POST['user']) ? $_POST['user'] : "");
$password = (isset($_POST['password']) ? $_POST['password'] : "");
$rol = (isset($_POST['rol']) ? $_POST['rol'] : "");
$description = (isset($_POST['description']) ? $_POST['description'] : "");

/* DEFINICION DE OBJETOS */
$obj = new UserDTO($id, $firstName, $secondName, $firstLastName, $secondLastName, $user, $password, $rol, $description);
$dao = new UserDAO();

/* CONTROL DE ACCIONES */
ExecuteAction($action, $obj, $dao);


