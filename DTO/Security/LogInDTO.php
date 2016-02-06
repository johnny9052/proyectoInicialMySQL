<?php

require_once ('../../DTO/BaseDTO.php');

class LogInDTO extends BaseDTO{

    private $user;
    private $password;

    public function __Construct($user, $password) {
        $this->user = $user;
        $this->password = $password;        
    }
        
    function getUser() {
        return $this->user;
    }

    function getPassword() {
        return $this->password;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setPassword($password) {
        $this->password = $password;
    }

           
}