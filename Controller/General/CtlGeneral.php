<?php

/*IMPORTS*/
require '../../DTO/General/GeneralDTO.php';
require '../../DAO/General/GeneralDAO.php';
include '../../Helper/Action/Load.php';

/*RECEPCION DE DATOS*/
$action = (isset($_POST['action']) ? $_POST['action'] : "");
$id = (isset($_POST['id']) ? $_POST['id'] : "");

/*DEFINICION DE OBJETOS*/
$obj = new GeneralDTO($id);
$dao = new GeneralDAO();

/* CONTROL DE ACCIONES */
ExecuteActionLoad($action, $obj, $dao);


