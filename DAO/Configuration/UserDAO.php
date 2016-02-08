<?php

/**
 * Definicion de acciones para la gestion de los usuarios
 *
 * @author Johnny Alexander Salazar
 * @version 0.1
 */
class UserDAO {

    private $repository;

    function UserDAO() {
        require_once '../../Infraestructure/Repository.php';
        $this->repository = new Repository();
    }

    /**
     * Ejecuta un guardar en la base de datos
     * @param UserDTO $obj 
     * @return void      
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function Save(UserDTO $obj) {
        $query = $this->repository->buildQuerySimply("saveuser", array((int) $obj->getId(),
            (string) $obj->getFirstName(), (string) $obj->getSecondName(),
            (string) $obj->getFirstLastName(), (string) $obj->getSecondLastName(),
            (string) $obj->getUser(), (string) md5($obj->getPassword()),
            (int) $obj->getRol(), (string) $obj->getDescription()));
        $this->repository->ExecuteTransaction($query);
    }

    /**
     * Ejecuta un listar en la base de datos
     * @param UserDTO $obj 
     * @return void      
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function ListAll(UserDTO $obj) {
        $query = $this->repository->buildQuery("listuser", array((int) $obj->getIdUser()));
        $this->repository->BuildPaginator($query);
    }

    /**
     * Ejecuta un buscar en la base de datos
     * @param UserDTO $obj 
     * @return void      
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function Search(UserDTO $obj) {
        $query = $this->repository->buildQuery("searchuser", array((int) $obj->getId()));
        $this->repository->Execute($query);
    }

    /**
     * Ejecuta un actualizar en la base de datos
     * @param UserDTO $obj 
     * @return void      
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function Update(UserDTO $obj) {
        $query = $this->repository->buildQuerySimply("updateuser", array((int) $obj->getId(),
            (string) $obj->getFirstName(), (string) $obj->getSecondName(),
            (string) $obj->getFirstLastName(), (string) $obj->getSecondLastName(),
            (string) $obj->getUser(), (string) md5($obj->getPassword()),
            (int) $obj->getRol(), (string) $obj->getDescription()));
        $this->repository->ExecuteTransaction($query);
    }

    /**
     * Ejecuta un borrar en la base de datos
     * @param UserDTO $obj 
     * @return void      
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function Delete(UserDTO $obj) {
        $query = $this->repository->buildQuerySimply("deleteuser", array((int) $obj->getId()));
        $this->repository->ExecuteTransaction($query);
    }

}
