<?php

/**
 * Description of Repository
 *
 * @author Johnny
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
     * Construye una consulta sql y retorna el resultado en un cursor
     *
     * @return string consulta armada
     * @param string $nameFunction Nombre de la funcion que se quiere ejecutar
     * @param array $array Vector que contiene los parametros que llevara la consulta
     * @author Johnny Alexander Salazar
     * @version 0.3
     */
    public function buildQuery($nameFunction, $array) {
        $query = "select " . $nameFunction . "(";

        if ($array) {//tiene parametros?
            for ($i = 0; $i < count($array); $i++) {
                (is_string($array[$i])) ? $query.="'" . $array[$i] . "'" : $query.=$array[$i]; //si es String pone comilla
                //echo $i. ' &&  '.count($array). ' ----';
                if ((int) ($i) < (int) (count($array) - 1)) { //si quedan mas parametros pone una ,
                    //echo 'entre';
                    $query.=",";
                }
            }
            $query.= ", 'res'); FETCH ALL IN res";
        } else {
            $query.= "'res'); FETCH ALL IN res";
        }
        return $query;
    }

    /**
     * Construye una consulta sql y retorna un dato con el nombre de res
     *
     * @return string consulta armada
     * @param string $nameFunction Nombre de la funcion que se quiere ejecutar
     * @param array $array Vector que contiene los parametros que llevara la consulta
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function buildQuerySimply($nameFunction, $array) {
        $query = "select " . $nameFunction . "(";

        for ($i = 0; $i < count($array); $i++) {
            (is_string($array[$i])) ? $query.="'" . $array[$i] . "'" : $query.=$array[$i]; //si es String pone comilla
            if ($i < count($array) - 1) { //si quedan mas parametros pone una ,
                $query.=",";
            }
        }
        $query.= ") as res;";
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

        $resultado = pg_query($this->objCon->getConnect(), $query) or die("Problemas en la consulta: " . pg_last_error());

        while ($reg = pg_fetch_array($resultado, null, PGSQL_ASSOC)) {
            $vec[] = $reg;
        }

        if (isset($vec)) {
            session_start();
            $_SESSION["User"] = pg_result($resultado, 0, 0);
            $_SESSION["UserName"] = pg_result($resultado, 0, 1) . " " . pg_result($resultado, 0, 2);
            $_SESSION["TypeUser"] = pg_result($resultado, 0, 3);
            echo(json_encode(['res' => 'Success', "msg" => $this->getLogInSuccess() . " " . pg_result($resultado, 0, 1) . " " . pg_result($resultado, 0, 2)]));
        } else {
            echo '{"res" : "Error", "msg" :"' . $this->getLogInError() . '" }';
        }
    }

    /**
     * Ejecuta una consulta sql enfocada a seleccionar datos y retorna al 
     * cliente su resultado
     *
     * @return string Echo de resultado de la consulta en formato JSON
     * @param string $query Consulta a ejecutar     
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function Execute($query) {
        $resultado = pg_query($this->objCon->getConnect(), $query) or die("Problemas en la consulta: " . pg_last_error());

        while ($reg = pg_fetch_array($resultado, null, PGSQL_ASSOC)) {
            $vec[] = $reg;
        }

        if (isset($vec)) {
            echo(json_encode($vec));
        } else {
            echo '{"res" : "Error"}';
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
        $resultado = pg_query($this->objCon->getConnect(), $query) or die("Problemas en la consulta: " . pg_last_error());

        while ($reg = pg_fetch_array($resultado, null, PGSQL_ASSOC)) {
            $vec[] = $reg;
        }

        if (pg_result($resultado, 0, 0) > 0) {
            echo(json_encode(['res' => 'Success', "msg" => $this->getOperationSuccess()]));
        } else {
            echo(json_encode(['res' => 'Error', "msg" => $this->getOperationError()]));
        }
    }

    /**
     * Ejecuta una consulta sql y retorna al su ejecutador el resultado
     *
     * @return string Echo de resultado de la consulta en formato JSON
     * @param string $query Consulta a ejecutar     
     * @author Johnny Alexander Salazar
     * @version 0.1
     */
    public function ExecuteReturn($query) {
        $resultado = pg_query($this->objCon->getConnect(), $query) or die("Problemas en la consulta: " . pg_last_error());

        while ($reg = pg_fetch_array($resultado, null, PGSQL_ASSOC)) {
            $vec[] = $reg;
        }

        if (isset($vec)) {
            return(json_encode($vec));
        } else {
            echo '{"res" : ' . $this->getOperationError() . '}';
        }
    }

    /**
     * Ejecuta una consulta sql y retorna una tabla HTML con el resultado de la consulta
     *
     * @return string Echo de resultado de la consulta en formato JSON, con variable res y conteniendo la talba
     * @param string $query Consulta a ejecutar     
     * @author Johnny Alexander Salazar
     * @version 0.2
     */
    public function BuildPaginator($query) {

        $resultado = pg_query($this->objCon->getConnect(), $query) or die("Problemas en la consulta: " . pg_last_error());

        if ($resultado && pg_numrows($resultado) > 0) {
            //$cadenaHTML = "<table class='centered responsive-table striped'>";
            $cadenaHTML = "<thead>";
            $cadenaHTML.= "<tr>";
            $cadenaHTML.= "<th data-field='sel'>registro #</th>";

            for ($cont = 1; $cont < pg_num_fields($resultado); $cont++) { //arma la cabecera de la tabla                
                $cadenaHTML .= "<th data-field='" . pg_field_name($resultado, $cont) . "'>" . pg_field_name($resultado, $cont) . "</th>";
                //VERIFICAR AQUI
            }

            $cadenaHTML .= "</tr>";
            $cadenaHTML .= "</thead>";

            $cadenaHTML .= "<tbody>";

            for ($cont = 0; $cont < pg_numrows($resultado); $cont++) { //recorre registro por registro
                //variable que contiene el tr con la funcion del selradio y el update data
                //$funcion = "<tr class='rowTable' onclick=showData([";
                $funcion = "<tr class='rowTable' onclick=search(";
                //variable que contiene los valores de los campos de la tabla
                $campos = "";
                //en el registro que se encuentre pinta sus campos y los saca para la funcion selradio y update data
                for ($posreg = 0; $posreg < pg_num_fields($resultado); $posreg++) {//por cada valor del registro
                    //Si se quieren añadir todos los datos solo es quitar el if,
                    //en este caso solo se esta colocando el id
                    if ($posreg == 0) {
                        $funcion.='\'' . pg_result($resultado, $cont, $posreg) . "'"; //lo añade a la funcion updatedata    
                    }
                    if ($posreg > 0) {//omite el id para no mostrarlo en los campos de la tabla
                        $campos.="<td>" . pg_result($resultado, $cont, $posreg) . "</td>";
                    }
                    //VERIFICAR AQUI
//                    if ($posreg < pg_num_fields($resultado) - 1) { //si quedan mas parametros por recorrer pone una ,
//                        $funcion.=",";
//                    }
                }


                //$funcion.= "]);showButton(false);>"; //finaliza la funcion updatedata
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
