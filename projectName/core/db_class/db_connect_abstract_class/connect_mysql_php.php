<?php

/**
 * Abstract Class for connect MySQL Database with mysqli
 * @var Class
 */
abstract class Conectar
{




    /**
     * Variables de Clase
     */

    /**
     * Permite definir la direccion o el dominio a cual apuntar
     * @var String
     */
    private static $db_host = 'localhost';

    /**
     * Permite definir el usuario con el que nos conectamos a la base de datos
     * @var String
     */
    private static $db_user = 'root';

    /**
     * Permite definir la constrasena de usuario
     * @var String
     */
    private static $db_pass = '';

    /**
     * Permite apuntar a una base de datos
     * @var String
     */
    protected static $db_name = 'grow_more_seed_db';



    /*
    *  Variables de CRUD
    */

    /**
     * Variable de conexion
     * @var mysqli (@params)
     */
    private $conn;





    /******************************* ZONA ABRIR Y CERRAR CONEXION *******************************************************/

    /**
     * Abrir una nueva CONEXION
     * @return none
     */
    private static function open_connection()
    {

        /**
         * self::$conn Crea el enlace con los parametros del servidor DB (host,user,pass,nameDB)
         * @var mysqli
         */
        self:$conn = new mysqli(self::$db_host, self::$db_user, self::$db_pass, self::$db_name);

        /**
         * self::$conn->set_charset decodificamos en utf8
         * @var String
         */
        self::$conn->set_charset("utf8");
    }


    /**
     * close_connection Cierra la conexion
     * @return none
     */
    private function close_connection()
    {
        /**
         * self::$conn->close Cierra el enlace
         * @var close()
         */
        self::$conn->close();
    }


    /******************************* FIN ZONA ABRIR Y CERRAR CONEXION *******************************************************/






    /******************************* ZONA CRUD DB *******************************************************/


    /**
     * execute_single_query  Ejecutar un query Simple del Tipo INSERT, DELETE, UPDATE
     * @param  String $query 'INSERT INTO table_name (column1, column2, column3, ...) VALUES (value1, value2, value3, ...);'
     * @return none
     */
    protected static function execute_single_query($query)
    {
        $this->open_connection();

        /**
         * self::$conn->query Ejecuta un query por meedio del enlace
         * @var String $query
         */
        self::$conn->query($query);

        $this->close_connection();
    }


    /**
     * get_results_from_query Realiza consulta y trae resultados de la misma CRUDOS
     * @param  String $query 'SELECT * FROM XXXX;'
     * @return mysqli_query Resultado de consulta CRUDO, REQUIERE UN TIPO FETCH, EJEMPLO FETCH_ALL
     */
    protected static function get_results_from_query($query)
    {
        $this->open_connection();
        $result_query = self::$conn->query($query);
        $this->close_connection();
        return $result_query;
    }


    /**
     * get_results_from_query_all Retorna el resultado de un Query en un array asociativo, numerico o ambos (MYSQLI_ASSOC, MYSQLI_NUM, o MYSQLI_BOTH)
     * @param  String $query 'SELECT * FROM XXXX;'
     * @param  String $tipoArrayRetorno (asociativo,numerico,ambos)
     * @return Array[]   Array asociativo, numerico o ambos.
     */
    protected static function get_results_from_query_all($query, $tipoArrayRetorno)
    {
        $this->open_connection();
        $parcialResult_query = self::$conn->query($query);
        $this->close_connection();
        if (strcasecmp("asociativo", $tipoArrayRetorno) == 0) {
            /**
             * $result_query es cargado con un array Asociativo es decir array("llave" => "valor")
             * @var Array[]
             */
            $result_query = mysqli_fetch_all($parcialResult_query, MYSQLI_ASSOC);
        } elseif (strcasecmp("numerico", $tipoArrayRetorno) == 0) {
            /**
             * $result_query es cargado con un array Numerico es decir array(0 => "valor")
             * @var Array[]
             */
            $result_query = mysqli_fetch_all($parcialResult_query, MYSQLI_NUM);
        } elseif (strcasecmp("ambos", $tipoArrayRetorno) == 0) {
            /**
             * $result_query es cargado con un array Dual es decir array("llave" => "valor",0 => "valor")
             * @var Array[]
             */
            $result_query = mysqli_fetch_all($parcialResult_query, MYSQLI_BOTH);
        } else {
            $result_query = null;
        }

        return $result_query;
    }


    /**
     * get_results_from_query_array Retorna el resultado de un Query en un array asociativo, numerico o ambos (MYSQLI_ASSOC, MYSQLI_NUM, o MYSQLI_BOTH)
     * @param  String $query 'SELECT * FROM XXXX;'
     * @param  String $tipoArrayRetorno (asociativo,numerico,ambos)
     * @return Array[]   Array asociativo, numerico o ambos.
     */
    protected static function get_results_from_query_array($query, $tipoArrayRetorno)
    {
        $this->open_connection();
        $parcialResult_query = self::$conn->query($query);
        $this->close_connection();
        if (strcasecmp("asociativo", $tipoArrayRetorno) == 0) {
            /**
             * $result_query es cargado con un array Asociativo es decir array("llave" => "valor")
             * @var Array[]
             */
            $result_query = mysqli_fetch_array($parcialResult_query, MYSQLI_ASSOC);
        } elseif (strcasecmp("numerico", $tipoArrayRetorno) == 0) {
            /**
             * $result_query es cargado con un array Numerico es decir array(0 => "valor")
             * @var Array[]
             */
            $result_query = mysqli_fetch_array($parcialResult_query, MYSQLI_NUM);
        } elseif (strcasecmp("ambos", $tipoArrayRetorno) == 0) {
            /**
             * $result_query es cargado con un array Dual es decir array("llave" => "valor",0 => "valor")
             * @var Array[]
             */
            $result_query = mysqli_fetch_array($parcialResult_query, MYSQLI_BOTH);
        } else {
            $result_query = null;
        }

        return $result_query;
    }


    /**
     * get_results_from_query_assoc Retorna la consulta en un array Asociativo
     * @param  String $query 'SELECT * FROM XXXX;'
     * @return Array[]  Retorna Array Asociativo ("llave" => "valor")
     */
    protected static function get_results_from_query_assoc($query)
    {
        $this->open_connection();
        $parcialResult_query = self::$conn->query($query);
        $this->close_connection();

        /**
         * $result_query Retorna la consulta en un Array asociativo
         * @var Array[]
         */
        $result_query = mysqli_fetch_assoc($parcialResult_query);

        return $result_query;
    }


    /**
     * get_results_from_query_row Retorna la consulta en un array enumerado
     * @param  String $query 'SELECT * FROM XXXX;'
     * @return Array[]  Retorna array numerico (0 => "valor")
     */
    protected static function get_results_from_query_row($query)
    {
        $this->open_connection();
        $parcialResult_query = self::$conn->query($query);
        $this->close_connection();

        /**
         * $result_query Retorna la consulta en un Array enumerado
         * @var Array[]
         */
        $result_query = mysqli_fetch_row($parcialResult_query);

        return $result_query;
    }


    /**
     * get_results_from_query_row Retorna la consulta en un array enumerado
     * @param  String $query 'SELECT * FROM XXXX;'
     * @return Array[]  Retorna array numerico (0 => "valor")
     */
    protected static function get_num_from_row_query($query)
    {
        $this->open_connection();
        $parcialResult_query = self::$conn->query($query);
        $this->close_connection();

        /**
         * $result_query Retorna el numero de filas de un Query
         * @var Array[]
         */
        $result_query = mysqli_num_rows($parcialResult_query);

        return $result_query;
    }


    /******************************* FIN ZONA CRUD DB *******************************************************/
}
