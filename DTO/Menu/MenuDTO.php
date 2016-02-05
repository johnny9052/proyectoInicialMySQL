<?php

require_once ('DTO/GeneralDTO.php');

class MenuDTO extends GeneralDTO {

    public function __Construct($IdRol) {
        parent::setIdRol($IdRol);        
    }

}
