<?php

/**
 * Definicion de acciones para la gestion de los roles
 * @author Johnny Alexander Salazar
 * @version 0.1
 */
class RolDAO {

    private $repository;

    function RolDAO() {
        require_once '../../Infraestructure/Repository.php';
        $this->repository = new Repository();
    }

    /**
     * Ejecuta un guardar en la base de datos
     * @param RolDTO $obj 
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
     * @param RolDTO $obj 
     * @return void      
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function ListAll(RolDTO $obj) {
        $query = $this->repository->buildQuery("listrol", array((int) $obj->getIdUser()));
        $this->repository->BuildPaginator($query);
    }

    /**
     * Ejecuta un buscar en la base de datos
     * @param RolDTO $obj 
     * @return void      
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function Search(RolDTO $obj) {
        $query = $this->repository->buildQuery("searchrol", array((int) $obj->getId()));
        $this->repository->Execute($query);
    }

    /**
     * Ejecuta un actualizar en la base de datos
     * @param RolDTO $obj 
     * @return void      
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function Update(RolDTO $obj) {
        $query = $this->repository->buildQuerySimply("updaterol", array((int) $obj->getId(),
            (string) $obj->getName(), (string) $obj->getDescription()));
        $this->repository->ExecuteTransaction($query);
    }

    /**
     * Ejecuta un borrar en la base de datos
     * @param RolDTO $obj 
     * @return void      
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function Delete(RolDTO $obj) {
        $query = $this->repository->buildQuerySimply("deleterol", array((int) $obj->getId()));
        $this->repository->ExecuteTransaction($query);
    }

}
