<?php

/* IMPORTS */
require 'DTO/Menu/MenuDTO.php';
require 'DAO/Menu/MenuDAO.php';


/* RECEPCION DE DATOS */
$rol = $_SESSION["TypeUser"];

/* DEFINICION DE OBJETOS */
$obj = new MenuDTO($rol);
$conex = new MenuDAO();

/* CONTROL DE ACCIONES */
$conex->LoadMenu($obj);

