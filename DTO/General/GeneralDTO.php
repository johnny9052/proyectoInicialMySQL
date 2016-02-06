<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GeneralDTO
 *
 * @author Johnny
 */
require_once ('../../DTO/BaseDTO.php');

class GeneralDTO extends BaseDTO {

    private $Id;

    public function __Construct($id) {
        $this->Id = $id;
    }

    function getId() {
        return $this->Id;
    }

    function setId($Id) {
        $this->Id = $Id;
    }

}
