<?php

/**
 * Definicion de acciones para la gestion de la seguridad al cargar un 
 * determinado menu solicitado por el usuario
 *
 * @author Johnny Alexander Salazar
 * @version 0.1
 */
class ContentDAO {

    private $repository;

    function ContentDAO() {
        require_once '../../Infraestructure/Repository.php';
        $this->repository = new Repository();
    }

    /**
     * Determina si un usuario que solicita una determinada pagina tiene
     * realmente los permisos necesarios para esto.
     * @param ContentDTO $obj 
     * @return void      
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function ValidatePage(ContentDTO $obj) {
        $query = $this->repository->buildQuery("loadapage", array((string) $obj->getPage(), (string) $obj->getIdRol()));        
        $this->repository->ExecuteLoadPage($query);
    }

}
