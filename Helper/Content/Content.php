<?php

require '../../DTO/Content/ContentDTO.php';
require '../../DAO/Content/ContentDAO.php';

session_start();

$idrol = $_SESSION["TypeUser"];
$page = (isset($_GET['page']) ? $_GET['page'] : "");

$obj = new ContentDTO($page, $idrol);
$conex = new ContentDAO();

$conex->ValidatePage($obj);
