<?php

require_once ('DTO/BaseDTO.php');

class MenuDTO extends BaseDTO {

    public function __Construct($IdRol) {
        parent::setIdRol($IdRol);        
    }

}
