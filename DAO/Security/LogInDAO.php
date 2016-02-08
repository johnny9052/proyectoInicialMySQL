<?php

/**
 * Definicion de acciones para la gestion de identificacion de usuarios
 * @author Johnny Alexander Salazar
 * @version 0.1
 */
class LogInDAO {

    private $repository;

    function LogInDAO() {
        require_once '../../Infraestructure/Repository.php';
        $this->repository = new Repository();
    }

    /**
     * Ejecuta una consulta login con los parametros usuario y contraseña
     * @param LogInDTO $obj 
     * @return void      
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function SignIn(LogInDTO $obj) {
        $query = $this->repository->buildQuery("login", array((string) $obj->getUser(), (string) md5($obj->getPassword())));
        $this->repository->ExecuteLogIn($query);
    }

}
