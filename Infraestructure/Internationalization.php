<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Internationalization
 *
 * @author Johnny
 */
class Internationalization {

    private $LogInError = "El usuario no existe";
    private $LogInSuccess = "Bienvenido";
    private $LogOutError = "Error al cerrar sesion";
    private $LogOutSuccess = "Sesion cerrada con exito";
    private $OperationSuccess = "Operacion exitosa";
    private $OperationError = "Error en la operacion";

    function getLogInError() {
        return $this->LogInError;
    }

    function getLogInSuccess() {
        return $this->LogInSuccess;
    }

    function getLogOutError() {
        return $this->LogOutError;
    }

    function getLogOutSuccess() {
        return $this->LogOutSuccess;
    }

    function getOperationSuccess() {
        return $this->OperationSuccess;
    }

    function getOperationError() {
        return $this->OperationError;
    }

    function setLogInError($LogInError) {
        $this->LogInError = $LogInError;
    }

    function setLogInSuccess($LogInSuccess) {
        $this->LogInSuccess = $LogInSuccess;
    }

    function setLogOutError($LogOutError) {
        $this->LogOutError = $LogOutError;
    }

    function setLogOutSuccess($LogOutSuccess) {
        $this->LogOutSuccess = $LogOutSuccess;
    }

    function setOperationSuccess($OperationSuccess) {
        $this->OperationSuccess = $OperationSuccess;
    }

    function setOperationError($OperationError) {
        $this->OperationError = $OperationError;
    }

}
