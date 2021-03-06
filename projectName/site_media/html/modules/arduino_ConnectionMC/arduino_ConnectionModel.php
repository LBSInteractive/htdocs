<?php

/***************************************************************************************
*            Modelo de arduino_Connection
***************************************************************************************/

// //Require Clase abstracta de conexion MySQL (mysqli)
// require_once '../../../../core/db_class/db_connect_abstract_class/connect_mysql_php.php';

// //Require Clase abstracta de conexion Oracle (PDO oci)
// require_once '../../../../core/db_class/db_connect_abstract_class/connect_oracle_php.php';

require_once '../../../../core/db_class/db_connect_abstract_class/connect_mysql_php.php';

/****************************************************************************************/
class Model extends Conectar
{

    /**
     * Variables
     */
    public $var = "DEFAULT";


    /**
     * __construct Apuntador de Base de Datos
     */
    public function __construct()
    {
        /**
         * parent::$db_name Cambiar Apuntador de Base de Datos
         * @var String
         */
        parent::$db_name = 'nombreBaseDeDatos';
    }


    /** SQL (mysqli)
     * obtener_lista_usuarios Ejemplo de Consulta a DB
     * @return Array[] Resultador de consulta en Array
     */
    public function obtener_lista_usuariosMYSQL()
    {
        $query = 'SELECT * FROM usuarios';
        $data = $this->get_results_from_query_assoc($query);
        return $data;
    }

    // /** Oracle (PDO oci)
    //  * obtener_lista_usuarios Ejemplo de Consulta a DB
    //  * @return Array[] Resultador de consulta en Array
    //  */
    // public function obtener_lista_usuariosORACLE()
    // {
    //     $query = 'SELECT * FROM usuarios';
    //     $data = $this->get_results_from_query_assoc($query);
    //     return $data;
    // }

}
/****************************************************************************************/
