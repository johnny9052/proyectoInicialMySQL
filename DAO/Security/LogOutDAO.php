<?php

/**
 * Definicion de acciones para la gestion de desconexion del sistema
 * @author Johnny Alexander Salazar
 * @version 0.1
 */
class logOutDAO {

    private $con;
    private $objCon;

    function logOutDAO() {
        require '../../Infraestructure/Connection.php';
        $this->objCon = new Connection();
        $this->con = $this->objCon->connect();
    }

    /**
     * Destruye la sesion que se encuentra activa     
     * @return string response:0 en formato JSON
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function SignOut() {
        session_start();
        session_destroy();
        echo '{"res" : "Success", "msg" : "Sesion cerrada correctamente"}';
    }

}
