<?php

/* IMPORTS */
require '../../DAO/Security/LogOutDAO.php';

/* DEFINICION DE OBJETOS */
$conex = new logOutDAO();

/* CONTROL DE ACCIONES */
$conex->SignOut();


