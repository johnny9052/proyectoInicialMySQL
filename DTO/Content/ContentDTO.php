<?php

require_once ('../../DTO/BaseDTO.php');

class ContentDTO extends BaseDTO {
    
    private $page;

    public function __Construct($page, $rol) {
        $this->page = $page;
        $this->IdRol = $rol;
    }

    function getPage() {
        return $this->page;
    }

    function setPage($page) {
        $this->page = $page;
    }

}
