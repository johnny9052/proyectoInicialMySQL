<?php

function ExecuteActionLoad($action, $obj, $dao) {

    switch ($action) {

        case "loadRol":
            $dao->LoadRol($obj);
            break;

        default :
            echo 'No action found';
            break;
    }
}
