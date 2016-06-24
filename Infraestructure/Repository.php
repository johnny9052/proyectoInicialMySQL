<?php

/**
 * Repositorio con funciones genericas
 * @author Johnny Alexander Salazar
 * @version 0.1
 */
require_once 'Internationalization.php';

class Repository extends Internationalization {

    private $con;
    private $objCon;

    function Repository() {
        require 'Connection.php';
        $this->objCon = new Connection();
        $this->con = $this->objCon->connect();
    }

    /**
     * Construye una consulta sql y retorna el resultado en un cursor, este se
     * enfoca en procedimientos almacenados
     * @return string consulta armada
     * @param string $nameFunction Nombre de la funcion que se quiere ejecutar
     * @param array $array Vector que contiene los parametros que llevara la consulta
     * @author Johnny Alexander Salazar
     * @version 0.3
     */
    public function buildQuery($nameFunction, $array) {

        $query = "CALL " . $nameFunction . "(";

        if ($array) {//tiene parametros?
            for ($i = 0; $i < count($array); $i++) {
                (is_string($array[$i])) ? $query.="'" . $array[$i] . "'" : $query.=$array[$i]; //si es String pone comilla
                //echo $i. ' &&  '.count($array). ' ----';
                if ((int) ($i) < (int) (count($array) - 1)) { //si quedan mas parametros pone una ,
                    //echo 'entre';
                    $query.=",";
                }
            }
        }
        $query.= ");";
        return $query;
    }

    /**
     * Construye una consulta sql y retorna un dato con el nombre de res, este
     * se enfoca en funciones de la base de datos
     *
     * @return string consulta armada
     * @param string $nameFunction Nombre de la funcion que se quiere ejecutar
     * @param array $array Vector que contiene los parametros que llevara la consulta
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function buildQuerySimply($nameFunction, $array) {
        $query = "SELECT " . $nameFunction . "(";

        for ($i = 0; $i < count($array); $i++) {
            (is_string($array[$i])) ? $query.="'" . $array[$i] . "'" : $query.=$array[$i]; //si es String pone comilla
            if ($i < count($array) - 1) { //si quedan mas parametros pone una ,
                $query.=",";
            }
        }
        $query.= ");";
        return $query;
    }

    /**
     * Ejecuta una consulta sql y retorna su resultado, si encuentra algo inicia una sesion
     *
     * @return string Echo de resultado de la consulta en formato JSON
     * @param string $query Consulta a ejecutar     
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function ExecuteLogIn($query) {
        /* Le asigno la consulta SQL a la conexion de la base de datos */
        $resultado = $this->objCon->getConnect()->prepare($query);
        /* Executo la consulta */
        $resultado->execute();
        /* Si obtuvo resultados, entonces paselos a un vector */
        if ($resultado->rowCount() > 0) {
            $vec = $resultado->fetchAll(PDO::FETCH_ASSOC);
        }

        if (isset($vec)) {
            session_start();
            $_SESSION["User"] = $vec[0]['usuario'];
            $_SESSION["UserName"] = $vec[0]['primer_nombre'] . " " . $vec[0]['primer_apellido'];
            $_SESSION["TypeUser"] = $vec[0]['rol'];
            echo(json_encode(['res' => 'Success', "msg" => $this->getLogInSuccess() . " " . $vec[0]['primer_nombre'] . " " . $vec[0]['primer_apellido']]));
        } else {
            echo '{"res" : "Error", "msg" :"' . $this->getLogInError() . '" }';
        }
    }

    /**
     * Valida si se tiene permisos para acceder a la pagina solicitada
     * @return string Echo de resultado de la consulta en formato JSON
     * @param string $query Consulta a ejecutar     
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function ExecuteLoadPage($query) {

        /* Le asigno la consulta SQL a la conexion de la base de datos */
        $resultado = $this->objCon->getConnect()->prepare($query);
        /* Executo la consulta */
        $resultado->execute();

        /* Si obtuvo resultados, entonces paselos a un vector */
        if ($resultado->rowCount() > 0) {
            $vec = $resultado->fetchAll(PDO::FETCH_ASSOC);
        }

        if (isset($vec)) {
            $_SESSION["Page"] = $vec[0]['codigo'];
            header('location: ../../index.php');
        } else {
            header('location: ../../index.php');
        }
    }

    /**
     * Ejecuta una consulta sql enfocada a seleccionar datos y retorna al 
     * cliente su resultado
     * @return string Echo de resultado de la consulta en formato JSON
     * @param string $query Consulta a ejecutar     
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function Execute($query) {

        /* Le asigno la consulta SQL a la conexion de la base de datos */
        $resultado = $this->objCon->getConnect()->prepare($query);
        /* Executo la consulta */
        $resultado->execute();
        /* Si obtuvo resultados, entonces paselos a un vector */
        if ($resultado->rowCount() > 0) {
            $vec = $resultado->fetchAll(PDO::FETCH_ASSOC);
        }      

        if (isset($vec)) {
            echo(json_encode($vec));
        } else {
            echo ' {
                "res" : "Error"
            }';
        }
    }

    /**
     * Ejecuta una consulta sql enfocada a escritura (save, delete, update)
     *
     * @return string Echo de resultado de la consulta en formato JSON
     * @param string $query Consulta a ejecutar     
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function ExecuteTransaction($query) {
       
        /* Le asigno la consulta SQL a la conexion de la base de datos */
        $resultado = $this->objCon->getConnect()->prepare($query);
        /* Executo la consulta */
        $resultado->execute();
        /* Si obtuvo resultados, entonces paselos a un vector */
        if ($resultado->rowCount() > 0) {
            $vec = $resultado->fetchAll(PDO::FETCH_NUM);
        }      

        if ($vec[0][0]> 0) {
            echo(json_encode(['res' => 'Success', "msg" => $this->getOperationSuccess()]));
        } else {
            echo(json_encode(['res' => 'Error', "msg" => $this->getOperationError()]));
        }
    }

    /**
     * Ejecuta una consulta sql y retorna al su ejecutador resultado
     *
     * @return string Echo de resultado de la consulta en formato JSON
     * @param string $query Consulta a ejecutar     
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function ExecuteReturn($query) {
        /* Le asigno la consulta SQL a la conexion de la base de datos */
        $resultado = $this->objCon->getConnect()->prepare($query);
        /* Executo la consulta */
        $resultado->execute();
        /* Si obtuvo resultados, entonces paselos a un vector */
        if ($resultado->rowCount() > 0) {
            $vec = $resultado->fetchAll(PDO::FETCH_ASSOC);
        }


        if (isset($vec)) {
            return(json_encode($vec));
        } else {
            echo ' {
                "res" : ' . $this->getOperationError() . '
            }';
        }
    }

    /**
     * Ejecuta una consulta sql y retorna una tabla HTML con el resultado de la consulta
     * @return string Echo de resultado de la consulta en formato JSON, con variable res y conteniendo la talba
     * @param string $query Consulta a ejecutar     
     * @author Johnny Alexander Salazar
     * @version 0.5
     */
    public function BuildPaginator($query) {

        //Longitud maxima de los caracteres del listado
        $max = 25;

        /* Le asigno la consulta SQL a la conexion de la base de datos */
        $resultado = $this->objCon->getConnect()->prepare($query);
        /* Executo la consulta */
        $resultado->execute();

        /* Se meten los datos a un vector, organizados sus campos no por nombre, 
          si no enumarados */
        $vec = $resultado->fetchAll(PDO::FETCH_NUM);
        //echo $resultado->columnCount() . '----' . $resultado->rowCount();

        /* quedo pendiente mirar como saco todos los registros por un lado y 
         * los campos por el otro de ser necesario, para eso si se necesita 
         * sacar una copia de resultado despues del execute pues se hace.
         */

        if ($resultado->rowCount() > 0) {
            //$cadenaHTML = "<table class='centered responsive-table striped'>";
            $cadenaHTML = "<thead>";
            $cadenaHTML.= "<tr>";
            $cadenaHTML.= "<th data-field='sel'>registro #</th>";



            for ($cont = 1; $cont < $resultado->columnCount(); $cont++) { //arma la cabecera de la tabla
                $col = $resultado->getColumnMeta($cont);
                //Coloca la cabecera reempleazando los guiones bajos con espacios
                $cadenaHTML .= "<th data-field='" . $col['name'] . "'>" . str_replace("_", " ", $col['name']) . "</th>";
                //VERIFICAR AQUI
            }


            $cadenaHTML .= "</tr>";
            $cadenaHTML .= "</thead>";

            $cadenaHTML .= "<tbody>";


            for ($cont = 0; $cont < sizeof($vec); $cont++) { //recorre registro por registro
                //variable que contiene el tr con la funcion del selradio y el update data
                //$funcion = "<tr class='rowTable' onclick=showData([";
                $funcion = "<tr class='rowTable' onclick=search(";
                //variable que contiene los valores de los campos de la tabla
                $campos = "";
                //en el registro que se encuentre pinta sus campos y los saca para la funcion selradio y update data
                for ($posreg = 0; $posreg < $resultado->columnCount(); $posreg++) {//por cada valor del registro
                    //Si se quieren añadir todos los datos solo es quitar el if,
                    //en este caso solo se esta colocando el id
                    if ($posreg == 0) {
                        $funcion.='\'' . $vec[$cont][$posreg] . "'"; //lo añade a la funcion updatedata    
                    }
                    if ($posreg > 0) {//omite el id para no mostrarlo en los campos de la tabla
                        $campos.="<td>" . substr($vec[$cont][$posreg], 0, $max) .
                                ((strlen($vec[$cont][$posreg]) > $max) ? ".." : "") . "</td>";
                    }
                    //VERIFICAR AQUI
//                    if ($posreg < $resultado->columnCount() - 1) { //si quedan mas parametros por recorrer pone una ,
//                        $funcion.=",";
//                    }
                }


                //$funcion.= "]);showButton(false);>"; 
                //finaliza la funcion search
                $funcion.= ");>"; //finaliza la funcion updatedata
                $cadenaHTML.=$funcion . "<td>" . ($cont + 1) . "</td>";
                //$cadenaHTML.=$funcion;
                $cadenaHTML.=$campos . "</tr>";
            }

            $cadenaHTML.="</tbody>";
            //$cadenaHTML.="</table>";
        } else {
            $cadenaHTML = "<label>No hay registros en la base de datos</label>";
        }
        echo '[{"res" :"' . $cadenaHTML . '"}]';
    }

}
