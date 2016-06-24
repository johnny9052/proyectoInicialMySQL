<?php

/**
 * Definicion de acciones para la gestion de permisos de los usuarios
 *
 * @author Johnny Alexander Salazar
 * @version 0.1
 */
class PermissionDAO {

    private $repository;

    function PermissionDAO() {
        require_once '../../Infraestructure/Repository.php';
        $this->repository = new Repository();
    }

    /**
     * Ejecuta un actualizar en la base de datos
     * @param PermissionDTO $obj 
     * @return void      
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function Update(PermissionDTO $obj) {

        /* Se debe agregar una coma al final, para que el plsql pueda recorrerlo 
          como un array
         */
        $query = $this->repository->buildQuerySimply("updatepermission", array((int) $obj->getId(),
            (string) "" . $obj->getPermission() . ","));
        //echo $query;

        $this->repository->ExecuteTransaction($query);
    }

    /**
     * Retorna todos los menus con sus hijos
     * @return void      
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function LoadAllMenu() {
        $query = $this->repository->buildQuery("loadallmenu", null);
        $data = json_decode($this->repository->ExecuteReturn($query));
        //SE ENCUENTRAN LOS PADRES
        $padres = $this->FindFather($data);
        //A los padres se le añaden los hijos
        $padresHijos = $this->FindSon($padres, $data);
        //Se construye el menu        
        $menu = $this->BuildPermission($padresHijos);
        echo(json_encode(["res" => $menu]));
    }

    /**
     * Retorna todos los menus con sus hijos de un respectivo rol
     * @param PermissionDTO $obj 
     * @return void      
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function LoadPermission(PermissionDTO $obj) {
        $query = $this->repository->buildQuery("loadmenu", array((int) $obj->getId()));
        $data = json_decode($this->repository->ExecuteReturn($query));

        //SE ENCUENTRAN LOS PADRES
        $padres = $this->FindFather($data);
        //A los padres se le añaden los hijos
        $padresHijos = $this->FindSon($padres, $data);

        echo json_encode($padresHijos);
    }

    /**
     * Determina cuales son los menus padres que futuramente contendran hijos     
     * @param Array $data Array JSON
     * @return Array Lista unicamente con los padres, y con un espacio para
     * almacenar los hijos     
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function FindFather($data) {

        $padres = array();

        /* Se sacan los codigos de los padres */
        foreach ($data as $x) {
            if ($x->codpadre == "-1") {
                array_push($padres, ["id" => $x->id, "nombre" => $x->nombre, "prioridad" => $x->prioridad, "hijos" => ""]);
            }
        }

        /* Se pasa padres a un string con el encode, luego se vuelve a pasar aun array legible con el decode, 
          asi parezca bobo pasarlo y volverlo a colocar sin esto no reconoce los elementos del array como objetos */
        return json_decode(json_encode($padres));
    }

    /**
     * Determina cuales son los menus hijos y los añade a sus respectivos padres
     * @return Array Lista unicamente con los padres conteniendo internamente 
     * a sus hijos     
     * @param array $padres lista con todos los padres y el espacio para los hijos
     * @param array $data lista con todos los padres - hijos      
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function FindSon($padres, $data) {
        /* Por cada padre se sacan sus hijos */
        $pos = 0;
        foreach ($padres as $x) {
            $temp = array();

            foreach ($data as $y) {
                if ($x->id == $y->codpadre) {
                    array_push($temp, ["id" => $y->id, "nombre" => $y->nombre, "prioridad" => $y->prioridad, "codigo" => $y->codigo]);
                }
            }
            $padres[$pos]->hijos = $temp;
            $pos++;
        }

        return $padres;
    }

    /**
     * retorna codigo html con los menus que deberan ser mostrados al usuario   
     * @return String $menu Estructura del menu en html     
     * @param array $padres lista con todos los padres y sus hijos intermanente
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function BuildPermission($padres) {
        $menu = '';
        /* Se pinta el menu */
        foreach ($padres as $x) {
            //SI TIENE HIJOS PINTA EL PADRE Y SUS HIJOS
            if (count($x->hijos) > 0) {
                //INICIA EL PADRE
                $menu.= '<p class="flow-text">' . $x->nombre . '</p>';
                $hijos = json_decode(json_encode($x->hijos));
                foreach ($hijos as $y) {
                    //SE AÑADE CADA HIJO POR CADA PADRE
                    $menu.= '<input type="checkbox" id="' . $y->id . '" value="' . $y->id . '"/> <label for="' . $y->id . '">'
                            . $y->nombre . '</label> <br>';
                    //SE CIERRA EL HIJO
                }
                //SE CIERRA EL PADRE
            }
        }
        return $menu;
    }

}
