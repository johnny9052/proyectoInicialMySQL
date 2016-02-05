<?php

function ExecuteAction($action, $obj, $dao) {

    switch ($action) {
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

        default :
            echo 'No action found';
            break;
    }
}
