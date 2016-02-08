<?php

require_once ('../../DTO/BaseDTO.php');

class PermissionDTO extends BaseDTO {
    
    private $id;
    private $permission;

    public function __Construct($id, $permission) {
        $this->id = $id;
        $this->permission = $permission;
    }

    function getId() {
        return $this->id;
    }

    function getPermission() {
        return $this->permission;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPermission($permission) {
        $this->permission = $permission;
    }

}
