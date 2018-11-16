<?php

/***************************************************************************************
*            Modelo de home
***************************************************************************************/

//Require Clase abstracta de conexion
require_once '../../../../core/db_class/db_connect_abstract_class/connect_oracle_php.php';

/****************************************************************************************/
class Model extends Conectar
{
    /**
     * __construct Apuntador de Base de Datos
     */
    public function __construct()
    {
        /**
         * parent::$db_name Cambiar Apuntador de Base de Datos
         * @var String
         */
        parent::$db_name = 'ORACLETEST';
    }

    /**
     * obtener_lista_usuarios Ejemplo de Consulta a DB
     * @return Array[] Resultador de consulta en Array
     */
    public function obtener_lista_usuarios()
    {
        $query = 'SELECT * FROM ORACLETEST.USUARIOS';
        $data = parent::get_results_from_query_assoc($query);
        return $data;
    }
}
/****************************************************************************************/
