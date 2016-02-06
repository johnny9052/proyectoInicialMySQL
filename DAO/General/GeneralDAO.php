<?php

class GeneralDAO {

    private $repository;

    function GeneralDAO() {
        require_once '../../Infraestructure/Repository.php';
        $this->repository = new Repository();
    }

    /**
     * Ejecuta un select que sera cargado como foranea en un select en la interfaz
     *
     * @return void      
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function LoadRol(GeneralDTO $obj) {
        $query = $this->repository->buildQuery("loadrol", array((int) $obj->getId(), (int) $obj->getIdUser()));
        $this->repository->Execute($query);
    }

}
