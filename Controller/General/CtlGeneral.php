<?php

require '../../DTO/General/GeneralDTO.php';
require '../../DAO/General/GeneralDAO.php';
include '../../Helper/Action/Load.php';

$action = (isset($_POST['action']) ? $_POST['action'] : "");
$id = (isset($_POST['id']) ? $_POST['id'] : "");

$obj = new GeneralDTO($id);
$dao = new GeneralDAO();
ExecuteActionLoad($action, $obj, $dao);


