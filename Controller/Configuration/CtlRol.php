<?php

require '../../DTO/Configuration/RolDTO.php';
require '../../DAO/Configuration/RolDAO.php';
include '../../Helper/Action/Action.php';

$action = (isset($_POST['action']) ? $_POST['action'] : "");
$id = (isset($_POST['id']) ? $_POST['id'] : "");
$name = (isset($_POST['name']) ? $_POST['name'] : "");
$description = (isset($_POST['description']) ? $_POST['description'] : "");

$obj = new RolDTO($id, $name, $description);
$dao = new RolDAO();
ExecuteAction($action, $obj, $dao);


