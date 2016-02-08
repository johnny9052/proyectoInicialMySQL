<?php

/* IMPORTS */
require '../../DTO/Content/ContentDTO.php';
require '../../DAO/Content/ContentDAO.php';

/* RECEPCION DE DATOS */
session_start();
$idrol = $_SESSION["TypeUser"];
$page = (isset($_GET['page']) ? $_GET['page'] : "");

/* DEFINICION DE OBJETOS */
$obj = new ContentDTO($page, $idrol);
$conex = new ContentDAO();

/* CONTROL DE ACCIONES */
$conex->ValidatePage($obj);
