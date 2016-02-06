<?php

class loguinDAO {

    private $repository;

    function loguinDAO() {
        require_once '../../Infraestructure/Repository.php';
        $this->repository = new Repository();
    }

    /**
     * Ejecuta una consulta login con los parametros usuario y contraseña
     *
     * @return void      
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function SignIn(LogInDTO $obj) {
        $query = $this->repository->buildQuery("login", array((string) $obj->getUser(), (string) md5($obj->getPassword())));        
        $this->repository->ExecuteLogIn($query);
    }

}
