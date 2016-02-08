<?php

/**
 * Contiene el control de las acciones de la carga de los selects del sistema
 * @author Johnny Alexander Salazar
 * @version 0.1
 */
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
