<?php

/**
 * Abstract Class for connect Oracle Database with PDO
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
    private const DB_HOST = '127.0.0.1';

    /**
     * Permite definir el usuario con el que nos conectamos a la base de datos
     * @var String
     */
    private static $db_user = 'system';

    /**
     * Permite definir la constrasena de usuario
     * @var String
     */
    private static $db_pass = 'system';

    /**
     * Permite apuntar a una base de datos
     * @var String
     */
    protected static $db_name = 'ORACLETEST';


    /*
    *  Variables de Conexion
    */

    /**
     * Variable de conexion
     * @var PDO
     */
    private static $conn;

    /**
     * Variable $tns Transparent Network Substrate estricta por Oracle Conections
     * @var String
     */
    private static $tns = "(DESCRIPTION=(ADDRESS=(PROTOCOL=tcp)(HOST=".self::DB_HOST.")(PORT=1521)))";


    /******************************* ZONA ABRIR Y CERRAR CONEXION *******************************************************/

    /**
     * Abrir una nueva CONEXION
     * @return none
     */
    private function open_connection()
    {

        /**
         * $this->conn Crea el enlace con los parametros del servidor DB Oracle (Transparent Network Substrate (tns),user,pass,array(tipo de retorno al consultar))
         * @var PDO
         */
        self::$conn = new PDO('oci:dbname='.self::$tns, self::$db_user, self::$db_pass, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
    }


    /**
     * close_connection Cierra la conexion
     * @return none
     */
    private function close_connection()
    {
        /**
         * $this->conn->close Cierra el enlace
         * @var close()
         */
        self::$conn = null;
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
         * Prepared Statements
         * @var STMT
         */
        $sql_stmt = self::$conn->prepare($query);
        try {
            $result = $sql_stmt->execute();
        } catch (PDOException $e) {
            trigger_error('Ha ocurrido un Error al ejecutar la sentencia SQL:' . $e->getMessage(), E_USER_ERROR);
        }
        if ($result) {
            /**
             * rowCount retorna el numero de filas afectadas por la sentencias SQL
             * @var [type]
             */
            return $sql_stmt->rowCount();
        }
        $this->close_connection();
    }


    /**
     * get_results_from_query_assoc Retorna la consulta en un array Asociativo
     * @param  String $query 'SELECT * FROM XXXX;'
     * @return Array[]  Retorna Array Asociativo ("llave" => "valor")
     */
    protected function get_results_from_query_assoc($query)
    {
        $this->open_connection();
        $sql_stmt = self::$conn->prepare($query);
        $sql_stmt->execute();
        $result = $sql_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /******************************* FIN ZONA CRUD DB *******************************************************/
}
