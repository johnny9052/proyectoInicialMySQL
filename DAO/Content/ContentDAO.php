<?php

class ContentDAO {

    private $repository;

    function ContentDAO() {
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
    public function ValidatePage(ContentDTO $obj) {
        $query = $this->repository->buildQuery("loadapage", array((string) $obj->getPage(), (string) $obj->getIdRol()));
        $this->repository->ExecuteLoadPage($query);
    }

}
