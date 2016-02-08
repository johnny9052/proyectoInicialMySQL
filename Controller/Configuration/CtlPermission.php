<?php

/*IMPORTS*/
require '../../DAO/Configuration/PermissionDAO.php';
require '../../DTO/Configuration/PermissionDTO.php';

/*RECEPCION DE DATOS*/
$action = (isset($_POST['action']) ? $_POST['action'] : "");
$id = (isset($_POST['id']) ? $_POST['id'] : "");
$permission = (isset($_POST['permission']) ? $_POST['permission'] : "");

/*DEFINICION DE OBJETOS*/
$obj = new PermissionDTO($id, $permission);
$dao = new PermissionDAO();

/* CONTROL DE ACCIONES */
switch ($action) {
    case "load":
        $dao->LoadAllMenu();
        break;

    case "update":
        $dao->Update($obj);
        break;

    case "loadPermission":
        $dao->LoadPermission($obj);
}




