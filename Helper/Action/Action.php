<?php

/**
 * Contiene el control de las acciones basicas del sistema
 * @author Johnny Alexander Salazar
 * @version 0.1
 */
function ExecuteAction($action, $obj, $dao) {

    switch ($action) {

        /* Transaction CRUD */

        case "save":
            $dao->Save($obj);
            break;

        case "search":
            $dao->Search($obj);
            break;

        case "delete":
            $dao->Delete($obj);
            break;

        case "update":
            $dao->Update($obj);
            break;

        case "list":
            $dao->ListAll($obj);
            break;

        /* END Transaction CRUD */

        default :
            echo 'No action found';
            break;
    }
}
