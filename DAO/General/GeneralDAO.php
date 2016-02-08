<?php

/**
 * Definicion de acciones generales del sistema, como selects, etc.
 * @author Johnny Alexander Salazar
 * @version 0.1
 */
class GeneralDAO {

    private $repository;

    function GeneralDAO() {
        require_once '../../Infraestructure/Repository.php';
        $this->repository = new Repository();
    }

    /**
     * Ejecuta una consulta que sera cargado como foranea en un select 
     * en la interfaz
     * @param GeneralDTO $obj
     * @return void      
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function LoadRol(GeneralDTO $obj) {
        $query = $this->repository->buildQuery("loadrol", array((int) $obj->getId(), (int) $obj->getIdUser()));
        $this->repository->Execute($query);
    }

}
