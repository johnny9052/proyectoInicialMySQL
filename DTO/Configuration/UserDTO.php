<?php

require_once ('../../DTO/BaseDTO.php');

class UserDTO extends BaseDTO {
    
    private $id;
    private $firstName;
    private $secondName;
    private $firstLastName;
    private $secondLastName;
    private $user;
    private $password;
    private $rol;
    private $description;

    public function __Construct($id, $firstName, $secondName, $firstLastName, $secondLastName, $user, $password, $rol, $description) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->secondName = $secondName;
        $this->firstLastName = $firstLastName;
        $this->secondLastName = $secondLastName;
        $this->password = $password;
        $this->rol = $rol;
        $this->user = $user;
        $this->description = $description;
    }

    function getId() {
        return $this->id;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getSecondName() {
        return $this->secondName;
    }

    function getFirstLastName() {
        return $this->firstLastName;
    }

    function getSecondLastName() {
        return $this->secondLastName;
    }

    function getUser() {
        return $this->user;
    }

    function getPassword() {
        return $this->password;
    }

    function getRol() {
        return $this->rol;
    }

    function getDescription() {
        return $this->description;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setSecondName($secondName) {
        $this->secondName = $secondName;
    }

    function setFirstLastName($firstLastName) {
        $this->firstLastName = $firstLastName;
    }

    function setSecondLastName($secondLastName) {
        $this->secondLastName = $secondLastName;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setRol($rol) {
        $this->rol = $rol;
    }

    function setDescription($description) {
        $this->description = $description;
    }

}
