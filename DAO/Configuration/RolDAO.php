<?php

class RolDAO {

    private $repository;

    function RolDAO() {
        require_once '../../Infraestructure/Repository.php';
        $this->repository = new Repository();
    }

    /**
     * Ejecuta un guardar en la base de datos
     *
     * @return void      
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function Save(RolDTO $obj) {
        $query = $this->repository->buildQuerySimply("saverol", array((int) $obj->getId(),
            (string) $obj->getName(), (string) $obj->getDescription()));
        $this->repository->ExecuteTransaction($query);
    }

    /**
     * Ejecuta un listar en la base de datos
     *
     * @return void      
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function ListAll(RolDTO $obj) {
        $query = $this->repository->buildQuery("listrol", array((int) $obj->getIdUser()));
        $this->repository->BuildPaginator($query);
    }

}
