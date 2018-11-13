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
    protected $db_name = 'grow_more_seed_db';



    /*
    *  Variables de CRUD
    */

    /**
     * Variable de conexion
     * @var PDO
     */
    private $dbh;



    /******************************* ZONA ABRIR Y CERRAR CONEXION *******************************************************/

    /**
     * Abrir una nueva CONEXION
     * @return none
     */
    private function open_connection()
    {

        /**
         * $this->dbh Crea el enlace con los parametros del servidor DB (host,user,pass,nameDB)
         * @var PDO
         */
        $this->dbh = new PDO('OCI:dbname='.$this->db_name.'charset=UTF-8',self::$db_user,self::$db_pass);

    }

    /******************************* FIN ZONA ABRIR Y CERRAR CONEXION *******************************************************/






    /******************************* ZONA CRUD DB *******************************************************/


    /******************************* FIN ZONA CRUD DB *******************************************************/
}
