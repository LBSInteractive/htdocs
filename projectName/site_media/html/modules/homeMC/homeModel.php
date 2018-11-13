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
     * Variables
     */
    public $var = "DEFAULT";
    public $tns = "(DESCRIPTION=(ADDRESS=(PROTOCOL=tcp)(HOST=127.0.0.1)(PORT=1521)))";
      public $db_user = 'ORACLETEST';
      public $db_pass = 'toor';

    /**
     * __construct Apuntador de Base de Datos
     */
    public function __construct()
    {
        /**
         * $this->db_name Cambiar Apuntador de Base de Datos
         * @var String
         */
        $this->db_name = 'ORACLETEST';
        $this->dbh = new PDO('oci:dbname='.$this->tns, $this->db_user, $this->db_pass);
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
