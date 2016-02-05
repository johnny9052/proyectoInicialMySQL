<?php

require '../../DAO/Security/LogOutDAO.php';

$conex = new logOutDAO();
$conex->SignOut();


