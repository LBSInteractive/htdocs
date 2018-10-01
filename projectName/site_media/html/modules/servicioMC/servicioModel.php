<?php

/***************************************************************************************
*            Modelo de servicio
***************************************************************************************/

//Require Clase abstracta de conexion
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
         * $this->db_name Cambiar Apuntador de Base de Datos
         * @var String
         */
        $this->db_name = 'u948420309_esbdc';
    }


    /**
     * obtener_lista_usuarios Ejemplo de Consulta a DB
     * @return Array[] Resultador de consulta en Array
     */
    public function obtener_lista_usuarios()
    {
        $query = 'SELECT * FROM usuarios';
        $data = $this->get_results_from_query_assoc($query);
        return $data;
    }

}
/****************************************************************************************/
