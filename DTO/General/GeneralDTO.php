<?php


require_once ('../../DTO/BaseDTO.php');

class GeneralDTO extends BaseDTO {

    private $id;

    public function __Construct($id) {
        $this->id = $id;
    }

    function getId() {
        return $this->id;
    }

    function setId($Id) {
        $this->id = $Id;
    }

}
