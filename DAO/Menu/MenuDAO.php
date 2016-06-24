<?php

/**
 * Definicion de acciones de carga del menu del sistema
 * @author Johnny Alexander Salazar
 * @version 0.1
 */
class MenuDAO {

    private $repository;

    function MenuDAO() {
        require_once 'Infraestructure/Repository.php';
        $this->repository = new Repository();
    }

    /**
     * Segun el perfil del usuario, retorna al cliente el codigo html con los 
     * menus quedeberan ser mostrados al usuario   
     * @param MenuDTO $obj
     * @return void      
     * @author Johnny Alexander Salazar
     * @version 0.2
     */
    public function LoadMenu(MenuDTO $obj) {
        $query = $this->repository->buildQuery("loadMenu", array((int) $obj->getIdRol()));
        $data = json_decode($this->repository->ExecuteReturn($query));
        //SE ENCUENTRAN LOS PADRES
        $padres = $this->FindFather($data);        
        //A los padres se le añaden los hijos
        $padresHijos = $this->FindSon($padres, $data);        
        //Se construye el menu
        $menu = $this->BuildMenu($padresHijos);
        echo $menu;
    }

    /**
     * Retorna todos los menus de la base de datos
     * @return void      
     * @author Johnny Alexander Salazar
     * @version 0.2
     */
    public function LoadAllMenu() {
        $query = $this->repository->buildQuery("loadallmenu", array(''));
        $data = json_decode($this->repository->ExecuteReturn($query));

        //SE ENCUENTRAN LOS PADRES
        $padres = $this->FindFather($data);
        //A los padres se le añaden los hijos
        $padresHijos = $this->FindSon($padres, $data);
        //Se construye el menu        
        echo $padresHijos;
    }

    
    /**
     * Determina cuales son los menus padres que futuramente contendran hijos     
     * @return Array Lista unicamente con los padres, y con un espacion para
     * almacenar los hijos
     * @param array $data lista con todos los padres - hijos     
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function FindFather($data) {

        $padres = array();

        //echo json_encode($data);
        /* Se sacan los codigos de los padres */
        foreach ($data as $x) {
            echo 'entre';
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
    public function BuildMenu($padres) {
        /* Logo de la empresa */
        $menu = '<a id="logo-container"><img src="Resource/Multimedia/Images/Logo.png" class="Logo"></a>';
        /* Menu inicio */
        $menu.='<li><a href="index.php">Inicio</a></li>';


        /* Se pinta el menu */
        foreach ($padres as $x) {
            //SI TIENE HIJOS PINTA EL PADRE Y SUS HIJOS
            if (count($x->hijos) > 0) {

                //INICIA EL PADRE
                $menu.= '<li class="no-padding"><ul class="collapsible collapsible-accordion"><li>';
                $menu.= '<a class="collapsible-header">' . $x->nombre . '<i class="mdi-navigation-arrow-drop-down"></i></a>';
                $menu.= '<div class="collapsible-body"><ul>';

                $hijos = json_decode(json_encode($x->hijos));

                foreach ($hijos as $y) {
                    //SE AÑADE CADA HIJO POR CADA PADRE
                    $menu.= '<li><a href="Helper/Content/Content.php?page=' . $y->codigo . '">' . $y->nombre . '</a></li>';
                    //SE CIERRA EL HIJO
                }

                $menu.= '</ul></div></li></ul></li>';
                //SE CIERRA EL PADRE
            }
        }
        $menu.='<li class="left"><a href="#" id="btnDesconectar" class="right" onclick="LogOut();">Cerrar sesion<i class="small mdi-action-account-circle"></i></a></li>';
        return $menu;
    }

}
